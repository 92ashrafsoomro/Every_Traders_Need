import { defineStore } from "pinia";

import { errorHandler } from "@/services/responseHandleService";
import Auction from "@/models/auction.model";
import columns from './columns'
import { useAlertStore } from "@/stores/alertStore";
import General from "@/models/general.model";

export const useCsvStore = defineStore("CsvStore", {
    state: () => ({
        makes: {
           selected:null,
           search:null, 
           loading:false,
           data:[]  
        },
        models: {
           selected:null,
           search:null, 
           loading:false,
           data:[]  
        },
        variants: {
           selected:null,
           search:null, 
           loading:false,
           data:[]  
        },
        id: null,
        row:null,
        data: [],
        scrap: [],
        columns: columns,
        errors:{},
      
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
            this.data[row][key] = e;
        },
        ColRender(row) {   

            let item = {}
            this.columns.forEach((col) => {     
                let v = row?.[col.key];
                item[col.key] = v ? String(v).trim() : null;
            });
        
            return item;
            
        },
        openRow(row) {   

            let find = this.data[row];
            this.row = find ? find : null;
            
        },
        async makeSearch() {
            this.makes.loading = true;
            try {
                let res = await General.get('/api/cruds/make', {
                    search: this.makes.search
                });
                this.makes.data = res.data;
                this.makes.loading = false;
            } catch (error) {
                this.makes.data = [];
                this.makes.loading = false;
            }
        },
        async selectMake(item) {
            this.makes.selected = item;
            this.makes.search = null;
            this.makes.data = [];
            this.makes.loading = false;
        },
        async clearMake() {
            this.makes.selected = null;
            this.makes.search = null;
            this.makes.data = [];
            this.makes.loading = false;


            this.makes.selected = null;
            this.makes.search = this.row.make_id;
            this.models.selected = null;
            this.models.search = this.row.model_id;
            this.variants.selected = null;
            this.variants.search = this.row.variant_id;
        },


        async modelSearch() {

             if (!this.makes.selected) {
                return false;
            }

            this.models.loading = true;
            try {
                let res = await General.get('/api/cruds/model', {
                    search: this.models.search,
                    make_id:this.makes.selected.id,
                });
                this.models.data = res.data;
                this.models.loading = false;
            } catch (error) {
                this.models.data = [];
                this.models.loading = false;
            }
        },
        async selectModel(item) {
            this.models.selected = item;
            this.models.search = null;
            this.models.data = [];
            this.models.loading = false;
        },
        async clearModel() {
            this.models.selected = null;
            this.models.search = null;
            this.models.data = [];
            this.models.loading = false;
        },



        async variantSearch() {

            if (!this.makes.selected) {
                return false;
            }

            if (!this.models.selected) {
                return false;
            }

            this.variants.loading = true;
            try {
                let res = await General.get('/api/cruds/model', {
                    search: this.variants.search,
                    make_id: this.makes.selected.id,
                    model_id:this.models.selected.id,
                });
                this.variants.data = res.data;
                this.variants.loading = false;
            } catch (error) {
                this.variants.data = [];
                this.variants.loading = false;
            }
        },
        async selectVariant(item) {
            this.variants.selected = item;
            this.variants.search = null;
            this.variants.data = [];
            this.variants.loading = false;
        },
        async clearVariant() {
            this.variants.selected = null;
            this.variants.search = null;
            this.variants.data = [];
            this.variants.loading = false;
        }




    },


   


});
