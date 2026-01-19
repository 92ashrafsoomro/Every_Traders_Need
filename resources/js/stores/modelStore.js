import { defineStore } from "pinia";

import { toRaw } from "vue";
import General from "@/models/general.model";

export const useModelStore = defineStore("modelStore", {
    state: () => ({
    
    }),

    getters: {

    },

    actions: {
        // ==============================
        // Single Model
        // ==============================
        async getSingleVariant(makeId) {
            try {
                const res = await General.get('/api/cruds/model', {id:variantId })
                const data = res.data[0];
                console.log("model ", data);
                
                return data
            } catch (error) {
                return error
            } 
        },

    },

});
