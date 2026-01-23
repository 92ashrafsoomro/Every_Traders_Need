<template>
    <taskNav />
    <v-row style="max-width: 1400px;" class="mx-auto">
        <v-col cols="12" class="mt-2">
               
          
            <div class="border">
                <v-data-table-server height="400px" 
                    hover  
                    :loading="taskManagementStore.loading"
                    :headers="header" 
                    :items="taskManagementStore.items" 
                    :items-length="taskManagementStore.total"
                    item-value="id"
                    :lastPage="taskManagementStore.last_page" 
                    @update:options="taskManagementStore.getTaskManagement">
            
                    <template #item.action="{ item }">
                        <router-link :to="'/admin/taskManagement/edit/' + item.id" target="_blank">
                            <v-icon color="primary" size="20" class="editIconHover pa-4">mdi-pencil</v-icon>
                        </router-link>
                        <span class="px-2"></span>
                        <v-icon
                            small
                            class="clickable-icon pa-4" color="danger"
                            @click="taskManagementStore.deleteData(item.id)">
                                    mdi-delete
                        </v-icon>
                    </template>

                    <template v-slot:bottom>
                        <div class="py-2 d-flex justify-end border-t">
                            <custom-pagination 
                                :loading="taskManagementStore.loading" 
                                v-model:page="taskManagementStore.filter.page"
                                :lastPage="taskManagementStore.last_page" 
                                @page-changed="taskManagementStore.getTaskManagement" />
                        </div>
                    </template>

                </v-data-table-server>
            </div>
        </v-col>
    </v-row>
</template>
<script>
import taskNav from "./component/taskmanagementbutton.vue";
import { useTaskManagementStore } from "@/stores/taskManagementStore";

export default {
    components: { taskNav },

    data() {
        return {
            taskManagementStore: useTaskManagementStore(),
             header: [
            { title: "ID", value: "id" },
            { title: "Auction type", value: "auction_type.title" },
            { title: "Platform", value: "auction_house.name" },
            { title: "Auction Name", value: "auction_name" },
            { title:"Auction Date" , value : "date"},
            // { title: "Auction Time", value: "created_date" },
            { title: "Pak Time", value: "pak_time" },
            { title: "Lots", value: "lots" },
            // { title: "Src Lots", value: "scr_lots" },
            { title: "Status", value: "status" },
            { title: "Assigned To", value: "assign_to" },
            // { title: "Final Sheet", value: "final_sheet" },
            // { title: "Notes", value: "notes" },
             { title: "Action", key: "action" },
        ],
        };
    },
     watch: {
        'taskManagementStore.filter.length'(newVal, oldVal) {
            this.taskManagementStore.filter.page = 1;
            this.taskManagementStore.getTaskManagement()
        },
        'taskManagementStore.filter.auction_type'(newVal, oldVal) {
            this.taskManagementStore.getTaskManagement()
        },
        'taskManagementStore.filter.platform'(newVal, oldVal) {
            this.taskManagementStore.getTaskManagement()
        },
          'taskManagementStore.filter.status'(newVal) {
            this.taskManagementStore.filter.page = 1
            this.taskManagementStore.getTaskManagement()
  }
    },
    mounted() {
        this.taskManagementStore.getTaskManagement();
    },
};
</script>