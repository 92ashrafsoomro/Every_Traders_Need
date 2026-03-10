<template>

    <v-col cols="12">
        <v-row class="mt-4" no-gutters="">
            <v-col cols="12">
                <div class="scrollSec  pt-lg-0 pt-md-0  d-flex justify-md-space-between  h-100 pb-2">
                    <div class="d-flex  ">
                        <!-- <div class=" ">
                            <v-select label="Length" v-model="filter.length" :items="[10, 20, 30]"
                                @update:model-value="handleInput" variant="outlined" color="primary" width="120"
                                density="compact" />
                        </div> -->
                        <div class="d-flex align-center ml-2">
                            <span>
                                Total Records {{ totalItems }}
                            </span>
                        </div>
                    </div>
                    <div class="d-flex ">

                        <div class="px-0">
                            <v-text-field prepend-inner-icon="mdi-magnify" label="Reg No" v-model="filter.reg_search"
                                @update:model-value="handleInput" variant="outlined" color="primary" width="200"
                                density="compact" clearable />
                        </div>


                        <div class="px-lg-2 px-md-2 px-2">
                            <MakeDropdown width="200" label="Select Make" variant="outlined" item-title="name"
                                item-value="id" color="primary" density="compact" :model-value="filter.make"
                                @update:modelValue="handleInput($event, 'make')" clearable />
                        </div>

                        <div class="">

                            <ModelDropdown width="200" label="Select Model" variant="outlined" color="primary"
                                :make="filter.make" :model-value="filter.model" item-title="name" item-value="id"
                                @update:modelValue="handleInput($event, 'model')" clearable density="compact" />

                        </div>
                        <div class="px-2">
                            <v-text-field type="number" placeholder="Enter Year" :value="filter.year" variant="outlined"
                                color="primary" width="200" density="compact" clearable min="1900"
                                :max="new Date().getFullYear()" @update:model-value="handleInput($event, 'year')" />
                        </div>


                    </div>
                </div>
            </v-col>

            <v-col cols="12" class="mt-3">
                <div class="  border ">
                    <v-data-table-server class="" :headers="headers" :items="items" hide-default-footer=""
                        :items-length="totalItems" hover :loading="loading" item-value="id">

                        <template #item.vehicle="{ item }">
                            <router-link style="text-decoration: none; color: rgb(var(--v-theme-whiteLight)); "
                                :to="'/user/vehicle-detail/' + item.vehicle_id" class="vehicleName pa-2 rounded-sm "
                                target="_blank">
                                <span> {{ item.vehicle }} </span>
                            </router-link>
                        </template>
                        <template #item.auction_date="{ item }">
                            <div>
                                {{ item.auction_date.split(' ')[0] }}<br>
                                {{ item.auction_date.split(' ')[1] }}
                            </div>
                        </template>


                        <template #item.autoboli="{ item }">
                            -
                        </template>

                        <template #item.platform_title="{ item }">
                            <span style="background-color: #0080ff50; padding: 7px ; border-radius: 3px;">{{
                                item.platform_title
                                }}</span>
                        </template>

                        <template #item.action="{ item }">
                            <v-icon small class="clickable-icon pa-4" color="danger"
                                @click="deleteItems(item.vehicle_id)">
                                mdi-delete
                            </v-icon>
                        </template>

                        <!-- <template v-slot:bottom>
                            <div class="py-2 d-flex justify-end border-t">
                                <custom-pagination 
                                  :loading="loading" 
                                  v-model:page="filter.page"
                                  :lastPage="last_page" 
                                  @page-changed="loadItems" />
                            </div>
                        </template> -->


                    </v-data-table-server>
                </div>
            </v-col>
        </v-row>


    </v-col>


</template>

<script>

import MakeDropdown from "@/components/MakeDropdown.vue";
import ModelDropdown from "@/components/ModelDropdown.vue";
import YearDropdown from "@/components/YearDropdown.vue";
import General from "@/models/general.model";
import UserModel from "@/models/user.model";
import { useVehicleStore } from "@/stores/vehicleStore";

export default {
    name: "Alert",
    components: {
        MakeDropdown,
        ModelDropdown,
        YearDropdown
    },
    data() {
        return {
            filter: {
                make: null,
                model: null,
                reg_search: '',
                year: null,
                length: 10,
                page: 1,
                offset: 0,
            },
            vehicleStore: useVehicleStore(),
            last_page: 1,
            items: [],
            totalItems: 0,
            loading: false,
            headers: [
                // { title: "View", key: 'view', sortable: false },
                { title: "Reg", value: "reg" },
                { title: "Vehicle", value: "vehicle" },
                { title: "Year", value: "year" },
                { title: "CC", value: "cc" },
                { title: "mileage", value: "mileage" },
                { title: "Transmission", value: "transmission" },
                { title: "Auction House", value: "platform_title" },
                { title: "Date Time", value: "auction_date" },
                { title: "Action", value: "action" },
                // { title: "LAST BID", value: "last_bid" },
                // { title: "AUTOBOLI", key: "autoboli", sortable: false },
            ],
        }
    },
    mounted() {

        this.loadItems();
    },
    methods: {
        handleInput(value, field = null) {

            switch (field) {
                case 'make':
                    this.filter.make = value;
                    break;
                case 'model':
                    this.filter.model = value;
                    break;
                case 'year':
                    this.filter.year = value;
                    break;
                default:
                    break;
            }

            this.loadItems();
        },
        async loadItems() {

            this.loading = true;
            try {
                const res = await General.get("/api/notifications/userAlertList", this.filter);
                // console.log(res);
                this.items = res.data || [];
                this.totalItems = res.recordsTotal;
                this.filter.offset = res.offset;
                this.filter.page = res.page;
                this.last_page = res.last_page;

            } catch (error) {
                console.error("Error fetching userWatchList:", error);
                this.totalItems = 0;
                this.items = [];
            } finally {
                this.loading = false;
            }

        },
        async deleteItems(vehicle_id) {
            if (!confirm("Are you sure you want to delete this item?")) return

            this.loading = true
            const options = {
                vehicle_id: vehicle_id,
            };

            try {
                const res = await General.post("/api/notifications/removeInVehicleAlert", options);
                this.$alertStore.add(res.message || "Alert Deleted", "success");
                this.loadItems()
            } catch (error) {
                console.error(error);
                this.$alertStore.add(error.message || "Delete failed", "error");
            } finally {
                this.loading = false;
            }
        }

    },
};
</script>

<style scoped>
.table-border {
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    overflow: hidden;
    /* important: table border ko follow karega */
}

@media (max-width: 599px) {

    .scrollSec {
        overflow: auto;
    }
}

.vehicleName:hover {
    background-color: rgb(var(--v-theme-primary), 0.3);
    transition: 0.2s ease-in-out;
}
</style>
