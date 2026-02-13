<template>
    <usertitlebarauctionfinder title="Find & Analyse Auction Vehicles" 
        subtitle="Search live and recent auction lots with smart filters and instant valuation insights before you bid.">

        <div class="d-flex mt-6  ga-3">

            <v-btn variant="tonal" class="buttonBorder text-none px-5 py-2 "
                :class="{ 'bg-primary text-white ': auctionStore.auctionTab === true }"
                @click="auctionStore.toggleAuctionTab()" style="height: 50px;"> <span
                    class="text-capitalize text-body-1 "> Auction Finder</span> </v-btn>

            <v-btn variant="tonal" class="buttonBorder text-none px-5 py-2"
                :class="{ 'bg-primary text-white': auctionStore.auctionTab === false }"
                @click="auctionStore.toggleAuctionTab()" style="height: 50px; "><span
                    class="text-capitalize text-body-1"> Vehicle Valuation </span></v-btn>


        </div>

    </usertitlebarauctionfinder>

    <v-container class=" mx-0 mb-5 mt-0 " fluid="">
        <div class="px-5">
            <div class="d-flex flex-wrap w-100  mb-5 mt-2  mx-auto align-center">

                <!-- LEFT -->
                <div class="d-flex flex-wrap align-center    ga-2 flex-grow-1">

                    <!-- FILTER BUTTON -->
                    <div>
                        <v-btn v-if="!auctionStore.sidebar" color="primary" variant="outlined" prepend-icon="mdi-filter"
                            @click="auctionStore.toggleFilter()">
                            <span class="text-whiteLight text-capitalize text-body-1 d-lg-flex d-md-flex d-none">Show
                                Filter</span>
                        </v-btn>

                        <v-btn v-else color="primary" variant="outlined" prepend-icon="mdi-filter-off"
                            @click="auctionStore.toggleFilter()">
                            <span class="text-whiteLight text-capitalize text-body-1 d-lg-flex d-md-flex d-none">Hide
                                Filter</span>
                        </v-btn>


                    </div>

                    <!-- CLEAR ALL (FILTER OPEN ONLY) -->
                    <v-slide-x-transition>
                        <v-btn v-if="auctionStore.sidebar" color="danger" variant="text"
                            :disabled="!isAnyFilterSelected" prepend-icon="mdi-delete"
                            @click="auctionStore.ClearFilter()">
                            <span class="text-whiteLight text-capitalize" style="text-decoration: underline">
                                Clear All
                            </span>
                        </v-btn>
                    </v-slide-x-transition>

                    <!-- RECORD COUNT -->
                    <div class="px-3 mt-1">
                        {{ auctionStore.offset }} -
                        {{ auctionStore.offset + auctionStore.filter.length }}
                        of {{ auctionStore.total }} Vehicles
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="d-flex  align-center ga-3 ">

                    <div style="width: 130px" class="mt-lg-2 mt-md-2 mt-4 ">
                        <v-select persistent-placeholder v-model="auctionStore.filter.length"
                            @update:model-value="handleInput()" color="primary" variant="outlined" density="compact"
                            label="Length" :items="[10, 50, 100, 200, 500]" />
                    </div>

                    <div style="width: 200px" class="mt-lg-2 mt-md-2 mt-4">
                        <v-select persistent-placeholder v-model="auctionStore.filter.sort_by"
                            @update:model-value="handleInput()" color="primary" variant="outlined" density="compact"
                            item-title="name" item-value="id" label="Sort by" :items="sortingOptions" />
                    </div>

                </div>

            </div>
            <v-slide-y-transition>
                <div v-if="!auctionStore.sidebar && isAnyFilterSelected" class="mb-3">
                    <div class="d-flex flex-wrap ">

                        <!-- CHIPS SCROLL -->
                        <div class="d-flex align-center overflow-x-auto no-wrap">
                            <Chips />
                        </div>

                        <!-- CLEAR ALL UNDER CHIPS -->
                        <div class="mt-2">
                            <v-btn color="danger" variant="text" prepend-icon="mdi-delete"
                                @click="auctionStore.ClearFilter()">
                                <span class="text-whiteLight text-capitalize" style="text-decoration: underline">
                                    Clear All
                                </span>
                            </v-btn>
                        </div>

                    </div>
                </div>
            </v-slide-y-transition>
        </div>
        <v-row no-gutters class="mt-1 px-lg-5" >
            <!-- Desktop sidebar -->
            <v-slide-x-transition>
                <v-col v-if="auctionStore.sidebar" :class="{ 'sidebarOpen': auctionStore.sidebar }" cols="12" md="3"
                    lg="2" class="desktop-sidebar d-none d-md-block bg-surface pa-0  border" style="height: calc(100vh - 50px);  position: sticky;
                    top: 75px;">

                    <div class="d-flex    align-center justify-space-between pa-3 border-b" style=" position: sticky;
                    top: 0px;
                    background-color: rgba(var(--v-theme-primary), 0.2) !important;
                    backdrop-filter: blur(6px); 
                    -webkit-backdrop-filter: blur(6px);
                    transition: background-color 0.3s ease;
                    z-index: 100;">
                        <h5 class="text-h6 font-weight-bold">Smart Filter</h5>
                    </div>

                    <div class="bg-surface pa-4  h-100 ">
                        <auctionSidebar />
                    </div>
                </v-col></v-slide-x-transition>




            <!-- OVERLAY (click outside) -->
            <div v-if="auctionStore.sidebar" class="position-fixed  d-md-none d-lg-none" style=" inset: 0;
                 background: rgba(0, 0, 0, 0.3);
                 z-index: 99;" @click="auctionStore.toggleFilter()"></div>

            <!-- MOBILE SIDEBAR -->
            <v-slide-x-transition>
                <div v-if="auctionStore.sidebar" class="desktop-sidebar position-fixed  d-md-none d-lg-none bg-surface"
                    @click.stop style="top: 60px; left: 0; width: 300px; background-origin: 0; z-index: 100;    overflow-y: auto;
                border-right: 2px solid rgb(var(--v-theme-border)); height: calc(100vh - 50px);">
                    <!-- Header -->
                    <div class="d-flex align-center justify-space-between px-4 pt-2 border-b"
                        style="background-color: rgb(var(--v-theme-primary),0.3);">
                        <h5 class="text-h6 font-weight-bold">Filter</h5>
                        <v-btn icon variant="text" @click="auctionStore.toggleFilter()">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </div>
                    <div class="bg-surface pa-4 " style="max-height: auto;">
                        <auctionSidebar />
                    </div>

                </div>
            </v-slide-x-transition>


          <v-col
  :cols="12"
  :md="auctionStore.sidebar ? 9 : 12"
  :lg="auctionStore.sidebar ? 10 : 12"
  :class="auctionStore.sidebar ? 'pl-md-6 pr-0' : 'pl-0 pr-0'"
>
  <div class="transition-col w-100">
    <component :is="currentComponent" />
  </div>
</v-col>


        </v-row>
    </v-container>
</template>

<script>
import AuctionFinder from "./auctionDetail.vue";
import VehicleValuation from "./vehicleValuation.vue";
import auctionSidebar from "./sidebar/index.vue";
import { useAuctionStore } from "@/stores/auctionStore";
import Chips from "./Chips.vue";
import usertitlebarauctionfinder from "@/tags/auctionfinder.vue"
export default {
    components: {
        AuctionFinder,
        VehicleValuation,
        auctionSidebar,
        usertitlebarauctionfinder,
        Chips
    },
    data() {
        return {

            // sidebar: false,
            auctionStore: useAuctionStore(),
        };
    },
    mounted() {

        this.auctionStore.loadSiderBarFilters();
        this.auctionStore.getAuctionList();
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
            return this.auctionStore.auctionTab ? "AuctionFinder" : "VehicleValuation";
        },
        isAnyFilterSelected() {
            const filter = this.auctionStore.filter

            const ignoreKeys = ['length', 'offset', 'sort_by', 'page']

            return Object.keys(filter).some(key => {
                if (ignoreKeys.includes(key)) return false

                const value = filter[key]

                if (Array.isArray(value)) {
                    return value.length > 0
                }

                return value !== null && value !== '' && value !== undefined
            })
        }
    },
    methods: {
        handleInput() {
            this.auctionStore.getAuctionList()
        },
        handleSearch() {
            this.auctionStore.getAuctionList();
        },


    },


};
</script>

<style scoped>
.main-div {
    position: relative;
}




@media (max-width: 786px) {

    .sidebarOpen .transition-col {
        width: 100% !important;
    }

    .sidebar {
        position: absolute;
        left: 0;
        margin-left: 0;

        bottom: 10px;
    }

}

.buttonBorder {
    border-radius: 2px;
}

/* Desktop Sidebar */
.desktop-sidebar {
    transition: width 0.3s ease;
}

.sidebarOpen {
    width: 250px;
    /* your sidebar width */
}

/* Mobile Sidebar */
.mobile-sidebar {
    transition: transform 0.3s ease, opacity 0.3s ease;
    transform: translateX(-100%);
    opacity: 0;
}
.transition-col {
  transition: padding-left 0.3s ease;
}

.mobile-sidebar.show {
    transform: translateX(0);
    opacity: 1;
}

.desktop-sidebar {
    overflow-y: auto;
    scrollbar-width: none;    
    -ms-overflow-style: none;  
}

.desktop-sidebar::-webkit-scrollbar {
    width: 0;
    height: 0;
    display: none;
}
</style>