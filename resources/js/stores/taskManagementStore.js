
// store/taskManagementStore.js
import { useAlertStore } from "@/stores/alertStore";
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
             {
                title: 'All',
                value: 'all',
                path: '/admin/taskManagement/all'
            }
            
        ],
        status: [
            { value: 'pending', title: 'Pending' },
            { value: 'processing', title: 'Processing' },
            { value: 'cancel', title: 'Cancel' },
            { value: 'scrapped', title: 'Scrapped' },
            { value: 'confirm', title: 'Confirm' },
            { value: 'done', title: 'Done' },
            { value: 'publish', title: 'Publish' },
        ],
        alertStore:useAlertStore(),
        totalTask : 0,
        totalTime : 0,
        totalLive : 0,
        pendingLive:0,
        pendingTime : 0,
        inprogressAuctions : 0,
        totalConfirmTask : 0 ,
        pendingTask:0,
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
                // this.liveAution = res.live_aution;   
                return res.data;
            } finally {
                this.loading = false;
            }
        },

         async statusChange(id,status){
           try {
              this.loading = true;
              const options = {id:id , status:status};
              let res  = await General.post("/api/cruds/taskManagement/changeStatus", options );
               await this.getTaskManagement();
               await this.getTaskCount()
            } catch (error) {
                console.error(error)
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
        },
        
        async getTaskCount() {
            this.loading = true;
            try {
                const res = await General.get('/api/cruds/taskManagement/counters');
                console.log(res.data);
                this.totalTask = res.data.total_task;
                this.totalLive = res.data.total_live;
                this.totalTime = res.data.total_timed;
                this.pendingTask = res.data.total_pending
                this.pendingLive = res.data.pending_live
                this.pendingTime = res.data.pending_timed
                this.processing = res.data.total_processing
                this.totalConfirmTask = res.data.total_confirm
                this.done = res.data.total_done
                this.publishAuction = res.data.total_publish
                this.publishLots = res.data.published_lots
                this.totaLots = res.data.total_lots
                this.confirmTask = res.data.confirm_count
//                 {
//     "data": {
//         "total_task": 1886,
//         "total_live": 1822,
//         "total_timed": 64,
//         "total_pending": 1,
//         "pending_live": 0,
//         "pending_timed": 0,
//         "total_confirm": 0,
//         "total_processing": 118,
//         "total_done": 1307,
//         "total_publish": 0,
//         "total_lots": 369281,
//         "published_lots": 369281
//     }
// }
            } finally {
                this.loading = false;
            }
        },

    },
});
