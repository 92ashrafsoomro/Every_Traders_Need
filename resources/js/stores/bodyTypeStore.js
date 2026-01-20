import { defineStore } from "pinia";

import { toRaw } from "vue";
import General from "@/models/general.model";

export const useBodyTypeStore = defineStore("BodyTypeStore", {
    state: () => ({
    
    }),

    getters: {

    },

    actions: {
        // ==============================
        // Single BodyType
        // ==============================
        async getSingleBodyType(vehicleId) {
            try {
                const res = await General.get('/api/cruds/bodyType', {id:vehicleId })
                const data = res.data[0];
                // console.log("model ", data);
                
                return data
            } catch (error) {
                return error
            } 
        },

    },

});
