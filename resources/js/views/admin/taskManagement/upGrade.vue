<template>
    <taskNav />
    <v-row style="max-width: 1400px;" class="mx-auto">
        <v-col cols="12" class="mt-2">
            <div class="border">
                <v-data-table-server hover :loading="taskManagementStore.loading" :headers="header" :items="taskManagementStore.items"
                    :items-length="taskManagementStore.total" @update:options="taskManagementStore.getTaskManagement" />

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
            { title: "Auction Time", value: "created_date" },
            { title: "Pak Time", value: "pak_time" },
            { title: "Lots", value: "lots" },
            { title: "Src Lots", value: "scr_lots" },
            { title: "Status", value: "status" },
            { title: "Assigned To", value: "assign_to" },
            { title: "Final Sheet", value: "final_sheet" },
            { title: "Notes", value: "notes" },
        ],
        };
    },

    mounted() {
        this.taskManagementStore.getTaskManagement();
    },
};
</script>
