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

        <div>
            <component :is="currentComponent" />
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
        };
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
