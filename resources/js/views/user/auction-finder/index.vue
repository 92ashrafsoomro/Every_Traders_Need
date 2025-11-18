<template>
    <main>
        <user-title-bar title="Smart Auction Search"
            subtitle="Filter, compare, and uncover vehicles that match your profit goals.">
            <div class="d-flex align-center ga-3">
                <v-btn variant="tonal" class="text-none px-5 py-2"
                    :class="{ 'bg-primary text-white': auctionStore.auctionTab === true}" @click="auctionStore.toggleAuctionTab()"> Auction Finder </v-btn>
                <v-btn variant="tonal" class="text-none px-5 py-2" :class="{ 'bg-primary text-white': auctionStore.auctionTab === false}" @click="auctionStore.toggleAuctionTab()"> Vehicle Valuation</v-btn>
            </div>
        </user-title-bar>
        <div class="mr-auto ml-auto pa-1 pa-sm-7">
            <div class="pb-3 d-flex align-center justify-space-between">
                <div class="d-flex w-100" >
                    <div class="px-3"  >
                        <v-btn 
                        color="primary" 
                        variant="outlined" 
                        prepend-icon="mdi-filter" 
                        @click="auctionStore.toggleFilter()"></v-btn>
                    </div>
                    <div class="w-100 px-3"  style="max-width: 300px;" >
                        <v-select 
                        persistent-placeholder 
                        v-model="auctionStore.filter.length"
                        @update:model-value="handleInput()" 
                        color="primary" 
                        variant="outlined" 
                        density="compact" 
                        label="Length"
                        :items="[10,50,100,200,500]" />
                    </div>
                    <div class="w-100 px-3"  style="max-width: 300px;" >
                        <v-select 
                            persistent-placeholder 
                            v-model="auctionStore.filter.sort_by"
                            @update:model-value="handleInput()"  
                            color="primary" 
                            variant="outlined" 
                            density="compact" 
                            item-title="name"
                            item-value="id"     
                            label="Sort by"
                            :items="sortingOptions" />
                    </div>
                    <div class="px-3">
                        <v-btn 
                        color="danger"
                        class="mx-2" 
                        variant="outlined" 
                        prepend-icon="mdi-delete" 
                        @click="this.auctionStore.ClearFilter()" />

                        <v-btn 
                        color="primary" 
                        variant="outlined" 
                        prepend-icon="mdi-magnify" 
                        @click="auctionStore.getAuctionList()" />
                    </div>
                    <div class="px-3">
                        {{auctionStore.offset}} - {{(auctionStore.offset + auctionStore.filter.length)}} of {{ auctionStore.total }} Vehicles
                    </div>
                </div>
            </div>
            <v-row class="d-flex align-start">
                <v-col v-if="auctionStore.sidebar" cols="12" :sm="auctionStore.sidebar ? 3 : 0" key="filter"
                    class="transition-col">
                    <v-col class="w-100 bg-surface rounded border pa-4">
                        <auctionSidebar/>
                    </v-col>
                </v-col>
                <v-col cols="12" :sm="auctionStore.sidebar ? 9 : 12" class="transition-col">
                    <component :is="currentComponent" />
                </v-col>
            </v-row>
        </div>
    </main>
</template>

<script>
import AuctionFinder from "./auctionDetail.vue";
import VehicleValuation from "./vehicleValuation.vue";
import auctionSidebar from "./sidebar/index.vue";
import { useAuctionStore } from "@/stores/auctionStore";

export default {
    components: {
        AuctionFinder,
        VehicleValuation,
        auctionSidebar
    },
    data() {
        return {
            auctionStore:useAuctionStore(),
        };
    },
    mounted() {
      
        this.auctionStore.loadSiderBarFilters(); 
        // this.auctionStore.getAuctionList();  
        this.$themeStore.menuType = 'collapsed';

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
            return this.auctionStore.auctionTab  ? "AuctionFinder" : "VehicleValuation";
        },
    },
    methods: {
        handleInput() {
            this.auctionStore.getAuctionList()
        },
    
    },
   
    
};
</script>

<style scoped></style>
