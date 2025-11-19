<template>
    <user-title-bar title="Watched & Alerted" subtitle="Track recently watched and alerted vehicles — stay ahead of every auction opportunity">
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
    </user-title-bar>

    <v-container>
        <v-row>
            <v-col cols="12" >
                <div class="pa-4 pt-6">
                    <component :is="currentComponent" />
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>

import Alerts from "./alerts.vue";
import Watchlist from "./watchlist.vue";

export default {
    components: {
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
