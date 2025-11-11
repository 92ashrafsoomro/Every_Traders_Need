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
                    <NewSelect label="Select Interest" density="compact" width="200" color="primary" />
                </div>
            </div>
            <!-- <DataTable class="rounded-lg mt-5" /> -->
            <div class="mt-5">
                <v-data-table-server class="dataTable rounded" :headers="headers" :items="items"
                    :items-length="totalItems" :loading="loading" item-value="id" @update:options="loadItems">
                    <!-- Image column -->
                    <template #item.image="{ item }">
                        <v-img :src="getFirstImage(item.image)" max-width="100" height="60" class="rounded" cover />
                    </template>

                    <!-- Action column -->
                    <template #item.action="{ item }">
                        <v-btn color="primary" size="small" @click="viewItem(item)">
                            View
                        </v-btn>
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
                { title: "Image", value: "image", sortable: false },
                { title: "Vehicle", value: "vehicle" },
                { title: "Year", value: "year" },
                { title: "CC", value: "cc" },
                { title: "Reg", value: "reg" },
                { title: "Mileage", value: "mileage" },
                { title: "Transmission", value: "transmission" },
                { title: "Last Bid (£)", value: "last_bid" },
                { title: "Cap Clean (£)", value: "cap_clean" },
                { title: "Cap Avg (£)", value: "cap_average" },
                { title: "Cap Below (£)", value: "cap_below" },
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
                const page = options.page || 1;
                const itemsPerPage = options.itemsPerPage || 10;
                const res = await this.vehicleStore.getUserWatchList({
                    length: itemsPerPage,
                    search: "",
                    page: page,
                });

                this.items = res.data || [];
                this.totalItems = res.recordsTotal || this.items.length;
            } catch (error) {
                console.error("Error fetching userWatchList:", error);
                this.vehicleStore.add(error, "error");
            } finally {
                this.loading = false;
            }
        },

        getFirstImage(images) {
            if (!images) return "";
            return images.split(",")[0].trim();
        },

        viewItem(item) {
            alert(`Viewing ${item.vehicle}`);
        },
    },
};
</script>

<style></style>
