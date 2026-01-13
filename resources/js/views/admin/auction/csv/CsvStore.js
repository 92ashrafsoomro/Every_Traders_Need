import { defineStore } from "pinia";

import { errorHandler } from "@/services/responseHandleService";
import Auction from "@/models/auction.model";
import columns from './columns'
import { useAlertStore } from "@/stores/alertStore";



export const useCsvStore = defineStore("CsvStore", {
    state: () => ({
        id:null,
        data: [],
        scrap: [],
        columns: columns,
      
    }),
    getters:{

    },
    actions: {
        
        async loadVehicle() {

            const alertStore = useAlertStore()          
            this.errors = {};
            this.loading = true;
     
            try {

                let res = await Auction.csvGet(this.id, {});
                let data = res.data.data;
                let modified = [];
                data.forEach(element => {
                    modified.push(this.ColRender(element));
                });
                this.data = modified;
                this.loading = false;
                // alertStore.add('Data Loaded', 'success');

            } catch (error) {
                this.loading = false;
                this.data = [];
                alertStore.add(error.message, 'error');
            }

        },

         async submit() {
            const alertStore = useAlertStore()
            this.errors = {};   
            this.loading = true;
            try {

                let res = await Auction.csvUpdate(this.id, { data: this.data });
                alertStore.add(res.message, 'success');
                this.loadVehicle();

            } catch (error) {

                alertStore.add(error.message, 'error');
                let validations = error.validation;
                if (validations) {
                    for (const key in validations) {
                        if (!Object.hasOwn(validations, key)) continue;
                        const element = validations[key];
                        this.errors[key] = element;
                    }
                }

            } finally {
                this.loading = false;
            }

        },
          
        async handleFile() {
            this.data = [];
            const alertStore = useAlertStore()
            this.loading = true;
            this.errors = {};
            try {

                let res = await Auction.getScrap(this.id, {});
                let data = res.data ?? [];
                let modified = await data.map((element) => {
                    let dd = this.ColRender(element);
                    return dd;
                })
        

                console.log('data get',modified);
                
                this.data = modified;
                // alertStore.add('Loaded Data From Scrapper', 'success');
                this.loading = false;

            } catch (error) {
                alertStore.add(error.message, 'error');
                this.loading = false;
            }
        },
        hanldeDailog(row, key, e) {
            // debugger
            this.data[row][key] = e;
            // this.data[row][key] = e;
        },
        ColRender(row) {   

            let item = {}
            this.columns.forEach((col) => {     
                let v = row?.[col.key];
                item[col.key] = v ? String(v).trim() : null;
            });
        
            return item;
            
        }


  
    },


   


});
