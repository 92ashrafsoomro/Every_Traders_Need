// store/taskManagementStore.js
import { defineStore } from "pinia";
import General from "@/models/general.model";

export const useTaskManagementStore = defineStore("taskManagementStore", {
    state: () => ({
        filter:{
            page: 1,
            length: 10,
            offset: 0,
            search: '',
        },
        items: [],
        loading: false,
        total: 0,
        last_page: 1,
    }),

    actions: {
        async getTaskManagement() {
            this.loading = true;
            try {
                const res = await General.get('/api/cruds/taskManagement',this.filter);
                this.items = res.data;
                this.total = Number(res.total);
                this.last_page = res.last_page;
                this.filter.offset = Number(res.offset);

                return res.data;
            } finally {
                this.loading = false;
            }
        },
    },
});
