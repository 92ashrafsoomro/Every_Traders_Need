import { defineStore } from "pinia";
import api from "../plugins/axios";

import { errorHandler } from "@/services/responseHandleService";
import { toRaw } from "vue";

export const useCsvStore = defineStore("CsvStore", {
    state: () => ({
        rows: [],
        vehicleType:'',
        
    }),
    getters:{

    },
    actions: {

        handleValue(row, key, value) {

            // debugger

            // let change = this.rows;

            console.log(toRaw(this.rows));
            
            

            // console.log(row,key,value);
            
            
        }

    },

});
