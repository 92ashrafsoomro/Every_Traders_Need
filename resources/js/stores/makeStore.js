import { defineStore } from "pinia";
import General from "@/models/general.model";

export const useMakeStore = defineStore("makeStore", {
    state: () => ({

    }),
    getters:{

    },
    actions: {
         // ==============================
        // Single Make 
        // ==============================
        async getSingleMake(modelId) {
                   try {
                       const res = await General.get('/api/cruds/make', {id:modelId })
                       const data = res.data[0];
                    //    console.log("make ", data);
                       
                       return data
                   } catch (error) {
                       return error
                   } 
               },
    },
});
