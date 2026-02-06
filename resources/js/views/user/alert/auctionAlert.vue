<template>

    <v-col cols="12">
        <v-row class="mt-5" no-gutters="">
            <v-col cols="12">
                <div class="scrollSec  pt-lg-0 pt-md-0  d-flex justify-md-space-between  h-100 pb-2">
                    <div class="d-flex  ">
                        <div class=" ">

                            <v-select label="Length" v-model="filter.length" :items="[10, 20, 30]"
                                @update:model-value="handleInput" variant="outlined" color="primary" width="120"
                                density="compact" />
                        </div>
                        <!-- <div class="px-2">
                            <YearDropdown label="All Years" :model-value="filter.year"
                                @update:model-value="handleInput($event, 'year')" item-title="label" item-value="id"
                                variant="outlined" color="primary" width="150" density="compact" clearable />
                        </div> -->
                    </div>
                    <div class="d-flex ">

                        <div class="px-0">
                            <v-text-field prepend-inner-icon="mdi-magnify" label="Reg No" v-model="filter.platform"
                                @update:model-value="handleInput" variant="outlined" color="primary" width="200"
                                density="compact" clearable />
                        </div>

                        <div class="px-lg-2 px-md-2 px-2">
                            <PlateformDropdown min-width="250px" max-width="274px" density="compact"
                                v-model="filter.platform" label="Auction House" clearable variant="outlined"
                                @update:modelValue="handleInput($event, 'platform')" base-color="white" />

                        </div>
                        <!-- <div class="px-lg-2 px-md-2 px-2">
                            <MakeDropdown width="200" label="Select Make" variant="outlined" item-title="name"
                                 item-value="id" color="primary"
                                density="compact" :model-value="filter.make"
                                @update:modelValue="handleInput($event, 'make')" clearable />
                        </div>

                        <div class="">

                            <ModelDropdown width="200" label="Select Model" variant="outlined" color="primary"
                                :make="filter.make" :model-value="filter.model"item-title="name"
                                 item-value="id"
                                @update:modelValue="handleInput($event, 'model')" clearable density="compact" />

                        </div> -->


                    </div>
                </div>
            </v-col>

            <v-col cols="12" class="mt-3">
                <div class="  border ">
                    <v-data-table-server class="" :headers="headers" :items="items" hide-default-footer
                        :items-length="totalItems" hover :loading="loading" item-value="id">
                        <!--
                        <template #item.vehicle="{item}">
                            <v-btn variant="plain" :to="'/user/vehicle-detail/'+ item.auction_id" target="_blank">{{ item.vehicle }}</v-btn>
                        </template> -->


                        <template #item.autoboli="{ item }">
                            -
                        </template>
                        <template #item.total_vehicle="{ item }">
                            <span>100</span>
                        </template>

                        <template #item.platform_title="{ item }">
                            <span
                                style="background-color: #0080ff50; padding: 7px ; border-radius: 3px;">{{ item.platform_title
                                }}</span>
                        </template>
                        <template #item.action="{ item }">
                            <v-icon small class="clickable-icon pa-4" color="danger"
                                @click="deleteItems(item.id)">
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
// import { usePageStore } from "@/stores/pageStore";
import PlateformDropdown from "@/components/PlateformDropdown.vue";

import { usePageStore } from "@/stores/pageStore";
export default {
    name: "Alert",
    components: {
        MakeDropdown,
        ModelDropdown,
        YearDropdown,
        PlateformDropdown
    },
    data() {
        return {
            filter: {
                platform: null,
                model: null,
                reg_search: '',
                year: null,
                length: 10,
                page: 1,
                offset: 0,
            },
            last_page: 1,
            items: [],
            auctionSheldulerList : usePageStore(),
            totalItems: 0,
            loading: false,
            headers: [
                // { title: "View", key: 'view', sortable: false },
                // { title: "Vehicle", value: "vehicle" , sortable: false},
                { title: "ID", value: "id" },
                { title: "Platform", value: "platform_name" },
                { title: "Auction Name", value: "name" },
                // { title: "Center", value: "cc" },
                { title: "Total Vehicle", value: "vehicles_count" },
                { title: "Time", value: "auction_date" },
                { title: "Status", value: "auction_status" },
                { title: "Action", value: 'action' }
                // { title: "Date Time", value: "auction_date" },
                // { title : "Action" , value : 'action'}
                // { title: "LAST BID", value: "last_bid" },
                // { title: "AUTOBOLI", key: "autoboli", sortable: false },
            ],
        }
    },
    watch: {

    },
    mounted() {

        this.loadItems();
    },
    methods: {
        handleInput(value, field = null) {

            switch (field) {
                case 'platform':
                    this.filter.platform = value;
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
                const res = await General.get("/api/notifications/userAuctionList", this.filter);
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
        async deleteItems(id) {
            if (!confirm("Are you sure you want to delete this item?")) return;

            this.loading = true;

            const options = {
                  auction_id: id
            };

            console.log("auction_id sending:", options);

            try {
                const res = await General.post("/api/notifications/removeInUserAuction", options);

                this.$alertStore.add(res.message || "Alert Deleted", "success");
                this.loadItems();

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
</style>
