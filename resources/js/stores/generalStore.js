import { defineStore } from "pinia";

export const useGeneralStore = defineStore('generalStore',{
     state: () => ({
       date:{
        start_date : '2025-12-1',
        end_date : '2026-02-28',
       }
    }),
})