import { defineStore } from "pinia";

import { toRaw } from "vue";
import General from "@/models/general.model";

export const useCenterStore = defineStore("centerStore", {
    state: () => ({
    
    }),

    getters: {

    },

    actions: {
        // ==============================
        // Single Platform
        // ==============================
        async getSingleCenter(platformId) {
            try {
                const res = await General.get('/api/cruds/center', {id:platformId })
                const data = res.data[0];
                // console.log("model ", data);
                
                return data
            } catch (error) {
                return error
            } 
        },

    },

});
