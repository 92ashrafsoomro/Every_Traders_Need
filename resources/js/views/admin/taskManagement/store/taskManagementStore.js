// store/taskManagementStore.js
import { defineStore } from "pinia";
import General from "@/models/general.model";

export const useTaskManagementStore = defineStore("taskManagementStore", {
    state: () => ({
        items: [],
        loading: false,
        total: 0,
    }),

    actions: {
        async getTaskManagement(taskId) {
            this.loading = true;
            try {                           // /api/cruds/taskManagement   
                const res = await General.get('/api/cruds/taskManagement', {id:taskId});
                this.items = res.data.data ?? res.data;
                this.total = res.data.total ?? this.items.length;

                return res.data;
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        },
    },
});
