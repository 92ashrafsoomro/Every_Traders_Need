<template>
    <taskNav />
    <v-row style="max-width: 1400px;" class="mx-auto">
        
        <v-col cols="12" class="mt-2">
                        <v-btn 
                            to="/admin/model/create"
                            color="primary"
                            class=""
                            style="height: 40px;"
                            variant="flat"
                            @click="loadItems"
                    >
                        <v-icon icon="mdi-plus"></v-icon>
                    </v-btn>
            <div class="border">
                <v-data-table-server
                    hover 
                    :loading="taskManagementStore.loading" 
                    :headers="header"
                    :items="taskManagementStore.items"
                    item-value="id"
                    :lastPage="taskManagementStore.last_page"
                    :items-length="taskManagementStore.total" 
                    @update:options="taskManagementStore.getTaskManagement" >
                
                    <template v-slot:bottom>
                        <div class="py-2 d-flex justify-end border-t">
                            <custom-pagination 
                                :loading="taskManagementStore.loading"
                                v-model:page="taskManagementStore.filter.page"
                                :lastPage="taskManagementStore.last_page"
                                @page-changed="taskManagementStore.getTaskManagement"
                            />
                        </div>
                    </template>
                </v-data-table-server>

            </div>
        </v-col>
    </v-row>
</template>
<script>
import taskNav from "./component/taskmanagementbutton.vue";
import { useTaskManagementStore } from "./store/taskManagementStore";

export default {
    components: { taskNav },

    data() {
        return {
            taskManagementStore: useTaskManagementStore(),
            header: [
            { title: "ID", value: "id" },
            // { title: "Auction type", value: "auction_type.title" },
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
        ],
        };
    },

    mounted() {
        this.taskManagementStore.getTaskManagement();
    },
};
</script>
