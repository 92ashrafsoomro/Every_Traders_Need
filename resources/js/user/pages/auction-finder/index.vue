<template>
    <main>
        <TitleBar title="Smart Auction Search"
            subtitle="Filter, compare, and uncover vehicles that match your profit goals.">
            <div class="d-flex align-center ga-3">
                <v-btn variant="tonal" class="text-none px-5 py-2"
                    :class="{ 'bg-primary text-white': activeTab === 'auction' }" @click="activeTab = 'auction'">
                    Auction Finder
                </v-btn>

                <v-btn variant="tonal" class="text-none px-5 py-2"
                    :class="{ 'bg-primary text-white': activeTab === 'valuation' }" @click="activeTab = 'valuation'">
                    Vehicle Valuation
                </v-btn>
            </div>
        </TitleBar>

        <div class="mr-auto ml-auto pa-1 pa-sm-7">
            <v-row class="d-flex align-center">
                <v-col>
                    <v-row class="d-flex align-center justify-space-between h-100 ps-2 pr-2">
                        <v-btn color="primary" variant="outlined" prepend-icon="mdi-filter" @click="toggleFilter">
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
                            <v-combobox color="primary" variant="outlined" density="compact" label="15"
                                :items="['50', '100', '100']" />
                        </v-col>
                        <v-col cols="12" sm="3">
                            <v-combobox color="primary" variant="outlined" density="compact" label="Sort by"
                                :items="['Name: A to Z', 'Name: Z to A', 'Grade: Low to High', 'Grade: High to Low', 'Date & Time: Oldest First', 'Date & Time: Newest First']" />
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
            <v-row class="d-flex align-start">
                <transition name="slide-fade" mode="out-in">
                    <v-col v-if="showFilterArea" cols="12" :sm="showFilterArea ? 3 : 0" key="filter"
                        class="transition-col">
                        <v-col class="w-100 bg-surface rounded border pa-4">
                            <v-expansion-panels>
                                <v-expansion-panel title="Vehicle Type">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Make">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Ford"></v-checkbox>
                                        <v-checkbox label="BMW"></v-checkbox>
                                        <v-checkbox label="Volkswagen"></v-checkbox>
                                        <v-checkbox label="Audi"></v-checkbox>
                                        <v-checkbox label="Vauxhall"></v-checkbox>
                                        <v-checkbox label="Nissan"></v-checkbox>

                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Model">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Model Variant">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Auction Date">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Auction House">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Auction Center">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Years">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Transmission">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Fuel Type">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Doors">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Seats">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Grade">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="V5">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Engine Size (CC)">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Former Keepers">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="No. of Services">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                                <v-expansion-panel title="Mileage">
                                    <v-expansion-panel-text>
                                        <v-checkbox label="Car"></v-checkbox>
                                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </v-col>
                    </v-col>

                </transition>
                <transition name="slide-fade" mode="out-in">
                    <v-col cols="12" :sm="showFilterArea ? 9 : 12" class="transition-col">
                        <component :is="currentComponent" />
                    </v-col>
                </transition>
            </v-row>
        </div>

    </main>
</template>

<script>
import TitleBar from "./../../component/TitleBar.vue";
import AuctionFinder from "./auctionFinder.vue";
import VehicleValuation from "./vehicleValuation.vue";

export default {
    components: {
        TitleBar,
        AuctionFinder,
        VehicleValuation,
    },
    data() {
        return {
            activeTab: "auction",
            showFilterArea: true,
        };
    },
    methods: {
        toggleFilter() {
            this.showFilterArea = !this.showFilterArea
        },
    },
    computed: {
        currentComponent() {
            return this.activeTab === "auction"
                ? "AuctionFinder"
                : "VehicleValuation";
        },
    },
};
</script>

<style scoped></style>
