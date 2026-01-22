// store/taskManagementStore.js
import { defineStore } from "pinia";
import General from "@/models/general.model";
import api from "@/plugins/axios";

export const useTaskManagementStore = defineStore("taskManagementStore", {
    state: () => ({
        filter: {
            page: 1,
            length: 10,
            offset: 0,
            search: '',
            name:'upComing'
        },
        taskPages: [
            {
                title: 'Up Coming',
                value: "upComing",
                path: '/admin/taskManagement/upComing'
            },
            {
                title: 'Time Auction',
                value: 'timeAuction',
                path: '/admin/taskManagement/timeAuction'
            },
            {
                title: 'Up Grade',
                value: 'upGrade',
                path: '/admin/taskManagement/upGrade'
            },
            {
                title: 'Final',
                value: 'final',
                path: '/admin/taskManagement/final'
            },
        ],
        items: [],
        loading: false,
        total: 0,
        page: '',
        length: "",
        last_page: 1,

    }),

    actions: {
       
        async selectTaskTab(value){
            this.filter.name = value;
            this.filter.page = 1
            this.getTaskManagement()  
        },
        async getTaskManagement() {
            this.loading = true;
            try {

                const res = await General.get('/api/cruds/taskManagement', this.filter );
                this.items = res.data;
                this.total = Number(res.total);
                this.last_page = res.last_page;
                this.filter.offset = Number(res.offset);

                return res.data;
            } finally {
                this.loading = false;
            }
        },


       async editTaskData(taskId) {
            this.loading = true;
            try {           
                const res = await General.get('/api/cruds/taskManagement', {id:taskId});
              const data = res.data[0];
                return data;
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async deleteData(id){
          if (!confirm("Are you sure you want to delete this item?")) return;
                this.loading = true;
        try {
            let res = await General.delete(`/api/cruds/taskManagement/${id}`)   
            this.getTaskManagement()
            return res.data;
        } catch (error) {
            this.$alertStore.error(error.message || "Delete feild" , 'error')       
        }finally {
            this.loading = false;
        }
    }
    },
    
});
