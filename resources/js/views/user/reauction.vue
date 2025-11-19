<template>
    <user-title-bar title="Reauction Tracker"
        subtitle="Monitor unsold lots making a comeback — compare prices, bids, and market movement.">
        
        <!-- <v-container class="contentArea d-flex align-center justify-start pb-0 ga-6 mb-n6 mb-sm-n5" fluid>
          
            <v-card class="redBox d-flex align-center justify-center flex-column ga-2 bg-danger  mb-n3"
                elevation="0">
                <v-card-title class="redBox-figure text-h2 text-white">0</v-card-title>
                <v-card-subtitle class="redBox-date text-body-2 text-white">Today</v-card-subtitle>
            </v-card>

            <v-card color="transparent" class="d-flex align-center justify-center flex-column ga-1" elevation="0">

                <v-row class="auction-house d-flex align-baseline justify-space-around ga-1 ga-sm-3" >
                    <v-col cols="auto">
                        <p>Auction House</p>
                    </v-col>
                    <v-col cols="auto">
                        <div class="wrapper bg-shadow pa-3 rounded flex-wrap">No Platforms</div>
                    </v-col>
                </v-row>

                <v-row class="auction-center d-flex align-baseline justify-space-around ga-5">
                    <v-col cols="auto">
                        <p>Auction Center</p>
                    </v-col>
                    <v-col cols="auto">
                        <div class="wrapper bg-shadow pa-3 rounded flex-wrap">No Centers</div>
                    </v-col>
                </v-row>
            </v-card>
        </v-container> -->
    </user-title-bar>
    <v-container class="pa-4 pt-6" fluid>
        <v-row>
            <v-col cols="12" >
                <div class="d-flex justify-md-space-between flex-wrap ">            
                    <div class="d-flex flex-wrap">
                            <div class="px-2" >
                                <v-select 
                                    label="Length"
                                    v-model="filter.length"
                                    :items="[10,20,30]" 
                                    @update:model-value="handleInput"
                                    variant="outlined"
                                    color="primary" 
                                    width="120" 
                                    density="compact" 
                                    />
                            </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="px-2" >
                            <v-text-field 
                                prepend-inner-icon="mdi-magnify"
                                label="Reg No" 
                                v-model="filter.reg"
                                @update:model-value="handleInput"
                                variant="outlined"
                                color="primary" 
                                width="200" 
                                density="compact" 
                                clearable />
                        </div>   
                    </div>
                </div>
            </v-col>

            <v-col cols="12">
                   <v-data-table-server 
                     :headers="headers" 
                     :items="items" 
                     :items-length="totalItems"
                     :loading="loading" 
                     item-value="id" 
                     @update:options="loadItems">
                     <template #item.action="{ item }">
                        <v-btn color="primary" to="/vehicle-detail" @click="viewItem(item)">View</v-btn>
                    </template>
                  </v-data-table-server>

            </v-col>
        </v-row>
       
 
    </v-container>

</template>

<script>

import { useMasterStore } from "@/stores/masterStore";
import { useVehicleStore } from "@/stores/vehicleStore";

export default {
    props: {},
    components: {
     
    },
    data() {
        return {
            filter: {
                reg: '',
                year: null,
                length: 10,
                page: 1,
                offset:0,
            },
            last_page:1,
            vehicleStore: useVehicleStore(),
            masterStore: useMasterStore(),
            items: [],
            totalItems: 0,
            loading: false,
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

</style>
