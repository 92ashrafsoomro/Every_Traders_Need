import { defineStore } from "pinia";

import { toRaw } from "vue";
import General from "@/models/general.model";

export const usePlatformStore = defineStore("platformStore", {
    state: () => ({
    
    }),

    getters: {

    },

    actions: {
        // ==============================
        // Single Platform
        // ==============================
        async getSinglePlatform(platformId) {
            try {
                const res = await General.get('/api/cruds/platform', {id:platformId })
                const data = res.data[0];
                // console.log("model ", data);
                
                return data
            } catch (error) {
                return error
            } 
        },

    },

});
