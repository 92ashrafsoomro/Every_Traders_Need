<template>
    <main>
        <user-title-bar title="Smart Auction Search"
            subtitle="Filter, compare, and uncover vehicles that match your profit goals.">
            <div class="d-flex align-center ga-3">
                <v-btn variant="tonal" class="text-none px-5 py-2"
                    :class="{ 'bg-primary text-white': vehicleStore.auctionTab === true}" @click="vehicleStore.toggleAuctionTab()">
                    Auction Finder
                </v-btn>
                <v-btn variant="tonal" class="text-none px-5 py-2"
                    :class="{ 'bg-primary text-white': vehicleStore.auctionTab === false}" @click="vehicleStore.toggleAuctionTab()">
                    Vehicle Valuation
                </v-btn>
            </div>
        </user-title-bar>

        <div class="mr-auto ml-auto pa-1 pa-sm-7">
            <v-row class="d-flex align-center">
                <v-col>
                    <v-row class="d-flex align-center justify-space-between h-100 ps-2 pr-2">
                        <v-btn color="primary" variant="outlined" prepend-icon="mdi-filter" @click="vehicleStore.toggleFilter()">
                            Toggle Filters
                        </v-btn>
                        <v-btn color="danger" variant="tonal" prepend-icon="mdi-delete">
                            Clear all
                        </v-btn>
                    </v-row>
                </v-col>
                <v-col cols="12" sm="9">
                    <v-row class="d-flex align-center justify-space-between h-100 ps-2 pr-2">
                        <v-col cols="12" sm="2">
                            <v-select 
                                persistent-placeholder 
                                v-model="vehicleStore.length" 
                                color="primary" 
                                variant="outlined" 
                                density="compact" 
                                label="Length"
                                :items="['10','50', '100', '200','500']" />
                        </v-col>
                        <v-col cols="12" sm="3">
                            <v-select 
                               persistent-placeholder 
                               v-model="vehicleStore.sort_by" 
                               color="primary" 
                               variant="outlined" 
                               density="compact" 
                               item-title="name"
                               item-value="id"     
                               label="Sort by"
                               :items="sortingOptions" />
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
            <v-row class="d-flex align-start">
                    <v-col v-if="vehicleStore.showFilterArea" cols="12" :sm="vehicleStore.showFilterArea ? 3 : 0" key="filter"
                        class="transition-col">
                        <v-col class="w-100 bg-surface rounded border pa-4">
                            <auctionSidebar/>
                        </v-col>
                    </v-col>
                    <v-col cols="12" :sm="vehicleStore.showFilterArea ? 9 : 12" class="transition-col">
                        <component :is="currentComponent" />
                    </v-col>
            </v-row>
        </div>

    </main>
</template>

<script>
import AuctionFinder from "./auctionFinder.vue";
import VehicleValuation from "./vehicleValuation.vue";
import auctionSidebar from "./auctionSidebar.vue";
import { useVehicleStore } from "@/stores/vehicleStore";
import { useThemeStore } from "@/stores/themeStore";

export default {
    components: {
        AuctionFinder,
        VehicleValuation,
        auctionSidebar
    },
    data() {
        return {
            vehicleStore:useVehicleStore(),
            themeStore: useThemeStore(),
        };
    },
    mounted() {
        this.vehicleStore.getAuctionList();  
        this.themeStore.menuType = "collapsed";
    },
    methods: {
       
    },
    computed: {
        sortingOptions() {
            return [
                { id: 'name-asc', name: 'Name: A to Z' },
                { id: 'name-dsc', name: 'Name: Z to A' },
                { id: 'grade-desc', name: 'Grade: Low to High' },
                { id: 'grade-asc', name: 'Grade: High to Low' },
                { id: 'date-desc', name: 'Date & Time: Oldest First' },
                { id: 'date-asc', name: 'Date & Time: Newest First' }
            ];
        },
        currentComponent() {
            return this.vehicleStore.auctionTab  ? "AuctionFinder" : "VehicleValuation";
        },
    },
};
</script>

<style scoped></style>
