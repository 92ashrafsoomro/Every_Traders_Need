<template>
    <user-title-bar title="Watched List"
        subtitle="Track recently watched and alerted vehicles — stay ahead of every auction opportunity">
        <div class="d-flex align-center ga-3 mt-6">
            <!-- <v-btn variant="tonal" class="buttonBorder text-none px-5 py-2 text-capitalize text-body-1" style="height: 50px; "
                :class="{ 'bg-primary text-white': activeTab === 'watchlist' }" @click="activeTab = 'watchlist'">
                WatchList
            </v-btn>
            <v-btn variant="tonal" class="buttonBorder text-none px-5 py-2 text-capitalize text-body-1" style="height: 50px; "
                :class="{ 'bg-primary text-white': activeTab === 'alerts' }" @click="activeTab = 'alerts'">
                Your Alerts
            </v-btn> -->
        </div>
    </user-title-bar>

    <div fluid style="max-width: 1400px;" class="mx-auto ">
        <v-row no-gutters="">
           <Watchlist/>

        </v-row>
    </div>
</template>

<script>

// import Alerts from "./alerts.vue";
import Watchlist from "./watchlist.vue";

export default {
    components: {
        // Alerts,
        Watchlist,
    },
    data() {
        return {
            // activeTab: "watchlist",
        };
    },
    computed: {
        // currentComponent() {
        //     return this.activeTab === "watchlist" ? "Watchlist" : "Alerts";
        // },
    },
};
</script>
<style>
.buttonBorder {
    border-radius: 2px;
}
</style>