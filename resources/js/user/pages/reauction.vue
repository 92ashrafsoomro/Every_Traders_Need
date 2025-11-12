<template>
    <TitleBar title="Reauction Tracker"
        subtitle="Monitor unsold lots making a comeback — compare prices, bids, and market movement.">
        <v-container class="contentArea d-flex align-center justify-start pb-0 ga-6 mb-n6 mb-sm-n5" fluid>
            <v-card class="redBox d-flex align-center justify-center flex-column ga-2 bg-danger rounded-t-lg mb-n3"
                elevation="0">
                <v-card-title class="redBox-figure text-h2 text-white">0</v-card-title>
                <v-card-subtitle class="redBox-date text-body-2 text-white">Today</v-card-subtitle>
            </v-card>

            <v-card color="transparent" class="d-flex align-center justify-center flex-column ga-1" elevation="0">
                <v-row class="auction-house d-flex align-baseline justify-space-around ga-1 ga-sm-3" align="baseline">
                    <v-col cols="auto">
                        <p>Auction House</p>
                    </v-col>
                    <v-col cols="auto">
                        <div class="wrapper bg-shadow pa-3 rounded flex-wrap">No Platforms</div>
                    </v-col>
                </v-row>

                <v-row class="auction-center d-flex align-baseline justify-space-around ga-5" align="baseline">
                    <v-col cols="auto">
                        <p>Auction Center</p>
                    </v-col>
                    <v-col cols="auto">
                        <div class="wrapper bg-shadow pa-3 rounded flex-wrap">No Centers</div>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>
    </TitleBar>


    <v-container class="pa-4 pt-6" fluid>
        <v-container class="mainContent mr-auto ml-auto" fluid>
            <v-row
                class="d-flex flex-wrap align-start align-sm-center justify-space-between flex-column flex-sm-row ga-5">
                <!-- LEFT ELEMENTS -->
                <v-col class="leftElements d-flex align-center ga-3" cols="12" sm="auto">
                    <v-select label="Year" :items="['2025', '2024', '2023', '2022', '2021', '2020']" variant="outlined"
                        color="primary" width="140" density="compact" clearable />
                </v-col>

                <!-- RIGHT ELEMENTS -->
                <v-col class="rightElements d-flex flex-wrap align-center ga-3" cols="12" sm="auto">
                    <v-text-field label="Search..." prepend-inner-icon="mdi-magnify" density="compact" width="200"
                        variant="outlined" color="primary" clearable />
                    <!-- <NewSelect label="Select Interest" density="compact" width="200" color="primary" /> -->
                </v-col>
            </v-row>

            <!-- <DataTable /> -->
            <div class="mt-4">
                <v-data-table-server class="dataTable" :headers="headers" :items="items" :items-length="totalItems"
                    :loading="loading" item-value="id" @update:options="loadItems">
                    <template #item.action="{ item }">
                        <v-btn color="primary" to="/vehicle-detail" @click="viewItem(item)">View</v-btn>
                    </template>
                </v-data-table-server>
            </div>
        </v-container>
    </v-container>

</template>

<script>
import TitleBar from "./../component/TitleBar.vue";
import DataTable from "./../component/dataTable.vue";
import NewSelect from "../component/newSelect.vue";
import { useVehicleStore } from "@/stores/vehicleStore";

export default {
    props: {},
    components: {
        TitleBar,
        DataTable,
        NewSelect,
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            items: [],
            totalItems: 0,
            loading: false,
            search: "",
            headers: [
                { title: "Name", value: "title" },
                { title: "Make", value: "make_name" },
                { title: "Vehicle", value: "model_name" },
                { title: "Reg", value: "reg" },
                { title: "Previous", value: "last_bid" },
                { title: "Platform", value: "platform_name" },
                { title: "Center", value: "center_name" },
                { title: "Cap Clean", value: "cap_clean" },
                { title: "Cap Average", value: "cap_average" },
                { title: "Mileage", value: "mileage" },
                { title: "Status", value: "bidding_status" },
                { title: "Time", value: "auction_date" },
                { title: "Action", value: "action", sortable: false },
            ],
        }
    },
    mounted() {
        this.loadItems({ page: 1, itemsPerPage: 10 });
    },
    methods: {
        async loadItems(options) {
            this.loading = true;
            try {
                // Extract page and itemsPerPage from options
                const page = options.page || 1;
                const itemsPerPage = options.itemsPerPage || 10;

                // Call your store API
                const response = await this.vehicleStore.getreAuctionList({
                    length: itemsPerPage,
                    search: this.search,
                    page: page, // optional if API supports page
                });

                // Populate table
                this.items = response.data; // array of vehicles
                this.totalItems = response.recordsTotal || response.data.length;
            } catch (error) {
                console.error("Error loading reAuctionList:", error);
                this.vehicleStore.add(error, "error");
            } finally {
                this.loading = false;
            }
        },

        viewItem(item) {
            alert(`View vehicle: ${item.title}`);
        },
    },
};
</script>

<style>
thead {
    white-space: nowrap;
}

tr {
    white-space: nowrap;
}
</style>
