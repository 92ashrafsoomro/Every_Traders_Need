// store/taskManagementStore.js
import { defineStore } from "pinia";
import General from "@/models/general.model";

export const useTaskManagementStore = defineStore("taskManagementStore", {
    state: () => ({
        filter: {
            page: 1,
            length: 10,
            platform: null,
            auction_type:null,
            offset: 0,
            status : null ,
            search: '',
            type:'timeAuction'
        },
       taskPages: [
            {
                title: 'Up Coming',
                value: 'upComing',
                path: '/admin/taskManagement/upComing'
            },
            {
                title: 'Update',
                value: 'update',
                path: '/admin/taskManagement/update'
            },
            {
                title: 'Final',
                value: 'final',
                path: '/admin/taskManagement/final'
            },
            
        ],
        status: [
     
            { value: 'pending', title: 'Pending' },
            { value: 'processing', title: 'Processing' },
            { value: 'cancel', title: 'Cancel' },
            { value: 'scrapped', title: 'Scrapped' },
            { value: 'confirm', title: 'Confirm' },
            { value: 'done', title: 'Done' },
            { value: 'import', title: 'Import' },
        ],
        totalTask : 0,
        liveAuction : 0,
        timeAuction : 0,
        inprogressAuctions : 0,
        confirmTask : 0 ,
        publishAuction : 0,
        processing : 0,
        done : 0,
        totaLots: 0,
        publishLots: 0,
        items: [],
        loading: false,
        total: 0,
        page: '',
        last_page: 1,
    }),

    actions: {
        async selectTaskTab(value){
            this.filter.type = value;
            this.filter.page = 1
            this.getTaskManagement()  
        },
        async getTaskManagement() {
            this.loading = true;
            try {
                const res = await General.get('/api/cruds/taskManagement', this.filter );
                this.items = res.data;
                this.total = Number(res.recordsTotal);
                this.last_page = res.last_page;
                this.filter.offset = Number(res.offset);
                this.liveAution = res.live_aution;   
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
