import { defineStore } from "pinia";

import { toRaw } from "vue";
import General from "@/models/general.model";

export const useVariantStore = defineStore("variant", {
    state: () => ({
    
    }),

    getters: {

    },

    actions: {
        // ==============================
        // Single Variant 
        // ==============================
        async getSingleVariant(variantId) {
            try {
                const res = await General.get('/api/cruds/variant', {id:variantId })
             
                return data
            } catch (error) {
                return error
            } 
        },

    },

});
