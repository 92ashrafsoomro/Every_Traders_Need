<template>
    <main>
        <TitleBar title="Watched & Alerted"
            subtitle="Track recently watched and alerted vehicles — stay ahead of every auction opportunity">
            <div class="d-flex align-center ga-3">
                <v-btn variant="tonal" class="text-none px-5 py-2"
                    :class="{ 'bg-primary text-white': activeTab === 'watchlist' }" @click="activeTab = 'watchlist'">
                    WatchList
                </v-btn>

                <v-btn variant="tonal" class="text-none px-5 py-2"
                    :class="{ 'bg-primary text-white': activeTab === 'alerts' }" @click="activeTab = 'alerts'">
                    Your Alerts
                </v-btn>
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
