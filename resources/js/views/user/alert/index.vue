<template>
  <user-title-bar
    title="Your Alert"
    subtitle="Track recently watched and alerted vehicles — stay ahead of every auction opportunity"
  >
    <div class="d-flex align-center ga-3 mt-6">
      <v-btn
        variant="tonal"
        class="buttonBorder text-none px-5 py-2 text-capitalize text-body-1"
        style="height: 50px;"
        :class="{ 'bg-primary text-white': activeTab === 'vehicle' }"
        @click="activeTab = 'vehicle'"
      >
        Vehicle
      </v-btn>

      <v-btn
        variant="tonal"
        class="buttonBorder text-none px-5 py-2 text-capitalize text-body-1"
        style="height: 50px;"
        :class="{ 'bg-primary text-white': activeTab === 'auction' }"
        @click="activeTab = 'auction'"
      >
        Auction Alerts
      </v-btn>
    </div>
  </user-title-bar>

  <div style="max-width: 1400px;" class="mx-auto mb-5">
    <div >
      <component :is="currentComponent" />
    </div>
  </div>
</template>

<script>
import Watchlist from "./alerts.vue"; 
import Alerts from "./auctionAlert.vue"; 

export default {
  components: {
    Watchlist,
    Alerts,
  },
  data() {
    return {
      activeTab: "vehicle",
    };
  },
  computed: {
    currentComponent() {
      return this.activeTab === "vehicle" ? "Watchlist" : "Alerts";
    },
  },
};
</script>

<style>
.buttonBorder {
  border-radius: 2px;
}
</style>
