import { defineStore } from "pinia";

import { errorHandler } from "@/services/responseHandleService";
import { useAlertStore } from "@/stores/alertStore";
import General from "@/models/general.model";

export const useMakeStore = defineStore("makeStore", {
    state: () => ({
        params: {
            
        },
        search:'',
        selected:null,
        loading:false,
        data:[]  
    }),
    getters:{

    },
    actions: {
        async searching() {
            try {

                this.loading = true;
                let res = await General.get('/api/cruds/make',params);

                this.data = res.data;
                this.loading = false;
                
            } catch (error) {
                
                this.data = [];
                this.loading = false;
            }
        },

    },
});
