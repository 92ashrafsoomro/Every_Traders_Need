<template>
    <main>
        <TitleBar title="Watched & Alerted"
            subtitle="Track recently watched and alerted vehicles — stay ahead of every auction opportunity">
            <div class="tabsContainer">
                <button :class="{ active: activeTab === 'watchlist' }" @click="activeTab = 'watchlist'">
                    WatchList
                </button>

                <button :class="{ active: activeTab === 'alerts' }" @click="activeTab = 'alerts'">
                    Your Alerts
                </button>
            </div>
        </TitleBar>

        <div class="pa-4 pt-6">
            <component :is="currentComponent" />
        </div>
    </main>
</template>

<script>
import TitleBar from "./../../component/TitleBar.vue";
import Alerts from "./alerts.vue";
import Watchlist from "./watchlist.vue";

export default {
    components: {
        TitleBar,
        Alerts,
        Watchlist,
    },
    data() {
        return {
            activeTab: "watchlist",
        };
    },
    computed: {
        currentComponent() {
            return this.activeTab === "watchlist" ? "Watchlist" : "Alerts";
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
