<template>
    <main>
        <TitleBar title="Smart Auction Search"
            subtitle="Filter, compare, and uncover vehicles that match your profit goals.">
            <div class="tabsContainer">
                <button :class="{ active: activeTab === 'auction' }" @click="activeTab = 'auction'">
                    Auction Finder
                </button>
                <button :class="{ active: activeTab === 'valuation' }" @click="activeTab = 'valuation'">
                    Vehicle Valuation
                </button>
            </div>
        </TitleBar>
        <div class="tab-content">
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

<style scoped>
.tabsContainer {
    display: flex;
    align-items: center;
    gap: 10px;
}

.tabsContainer button {
    padding: 10px 20px;
    border: 1px solid #353f4c;
    background-color: transparent;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 15px;
    font-weight: 500;
}

.tabsContainer button.active {
    background-color: #0080ff;
    color: white;
    border-color: #0080ff;
}
</style>
