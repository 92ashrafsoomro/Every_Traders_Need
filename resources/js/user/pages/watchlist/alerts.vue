<template>
    <div class="p-4 mainDiv">
        <div class="mainContent mr-auto ml-auto">
            <div
                class="d-flex flex-wrap align-start align-sm-center justify-space-between flex-column flex-sm-row ga-5">
                <div class="leftElements d-flex align-center ga-3">
                    <v-select label="Year" :items="['2025', '2024', '2023', '2022', '2021', '2020']" variant="outlined"
                        color="primary" width="140" density="compact" clearable></v-select>
                </div>
                <div class="rightElements d-flex flex-wrap align-center ga-3">
                    <v-text-field label="Search..." prepend-inner-icon="mdi-magnify" density="compact" width="200"
                        variant="outlined" color="primary" clearable></v-text-field>
                    <!-- <NewSelect label="Select Interest" density="compact" width="200" color="primary" /> -->
                </div>
            </div>
            <!-- <DataTable class="rounded-lg mt-5" /> -->
            <div class="mt-4">
                <v-data-table-server class="dataTable rounded" :headers="headers" :items="items"
                    :items-length="totalItems" :loading="loading" item-value="notification_id"
                    @update:options="loadItems">

                    <template #item.image="{ item }">
                        <v-img :src="item.image.split(',')[0]" width="100" height="60" cover class="rounded" />
                    </template>

                    <template #item.vehicle="{ item }">
                        <div>
                            <strong>{{ item.vehicle }}</strong><br />
                            <small>{{ item.year }} • {{ item.reg }}</small>
                        </div>
                    </template>

                    <template #item.last_bid="{ item }">
                        £{{ item.last_bid?.toLocaleString() }}
                    </template>

                    <template #item.auction_date="{ item }">
                        {{ new Date(item.auction_date).toLocaleDateString() }}
                    </template>
                </v-data-table-server>

            </div>
        </div>
    </div>
</template>

<script>
import NewSelect from "./../../component/newSelect.vue";
import DataTable from "../../component/dataTable.vue";
import { useVehicleStore } from "@/stores/vehicleStore";



export default {
    name: "Watchlist",
    components: {
        NewSelect,
        DataTable,
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            items: [],
            totalItems: 0,
            loading: false,
            headers: [
                { title: "Image", key: "image", sortable: false },
                { title: "Vehicle", key: "vehicle" },
                { title: "Reg", key: "reg" },
                { title: "Clean", key: "cap_clean" },
                { title: "Average", key: "cap_average" },
                { title: "Below", key: "cap_below" },
                { title: "Autotrader", key: "" },
                { title: "Auction", key: "auction_name" },
                { title: "Last Bid", key: "last_bid" },
                { title: "Action", key: "action" },
                // { title: "Year", key: "year" },
                // { title: "Mileage", key: "mileage" },
                // { title: "Auction Date", key: "auction_date" },
            ],
        };
    },
    methods: {
        async loadItems(options) {
            this.loading = true;
            try {
                const res = await this.vehicleStore.getAlertList({
                    length: options.itemsPerPage || 10,
                    search: options.search || "",
                });

                this.items = res.data || [];
                this.totalItems = res.recordsTotal || res.data.length;
                console.log("✅ Alert List Loaded:", this.items);
            } catch (error) {
                console.error("❌ Error loading alert list:", error);
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>

<style>
.mainContent {
    max-width: 1536px;
    padding: 0 24px;
    margin-left: auto;
    margin-right: auto;
}
</style>
