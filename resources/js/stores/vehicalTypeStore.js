import { defineStore } from "pinia";

import { toRaw } from "vue";
import General from "@/models/general.model";

export const useVehicalTypeStore = defineStore("VehicalTypeStore", {
    state: () => ({
    
    }),

    getters: {

    },

    actions: {
        // ==============================
        // Single VehicalType
        // ==============================
        async getSingleVehical(vehicleId) {
            try {
                const res = await General.get('/api/cruds/vehicleType', {id:vehicleId })
                const data = res.data[0];
                // console.log("model ", data);
                
                return data
            } catch (error) {
                return error
            } 
        },

    },

});
