<template>
  <v-window-item value="Servicehistory">
    <v-row dense>
      <!-- Service History Card -->
      <v-col cols="12" md="6">
        <v-card class="pa-4 rounded-lg elevation-2">
          <h2 class="text-h5 mb-4">Service History</h2>
          <v-list class="pa-0">
            <v-list-item
              v-for="(item, index) in mappedVehicleDetails"
              :key="index"
              class="px-0 rounded"
              :class="index % 2 === 0 ? 'bg-dark' : 'bg-light_color'"
            >
              <v-list-item-title class="font-weight-bold">{{ item.label }}</v-list-item-title>
              <v-list-item-subtitle class="text-right">
                {{ item.value }}
              </v-list-item-subtitle>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>

      <!-- Pricing Card -->
      <v-col cols="12" md="6">
        <v-card class="pa-4 rounded-lg elevation-2">
          <h2 class="text-h5 mb-4">Pricing</h2>
          <v-list class="pa-0">
            <v-list-item
              v-for="(item, index) in mappedPricingDetails"
              :key="index"
              class="px-0 rounded"
              :class="index % 2 === 0 ? 'bg-dark' : 'bg-light_color'"
            >
              <v-list-item-title class="font-weight-bold">{{ item.label }}</v-list-item-title>
              <v-list-item-subtitle class="text-right">
                {{ item.value }}
              </v-list-item-subtitle>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
  </v-window-item>
</template>



<script>
export default {
  name: "Vehicledetail",
  props: {
    vehicle: {
      type: Object,
      required: true,
    },
  },
  computed: {
    mappedVehicleDetails() {
      const v = this.vehicle;
      return [
        { label: "Service History", value: v.number_of_services_details || "N/A" },
        { label: "No of services", value: v.number_of_services_details || "N/A" },
        { label: "Service Through main dealers", value: v.model_name || "N/A" },
        { label: "Last Service", value: v.last_service || "N/A" },
        { label: "Last service mileage", value: v.last_service_mileage || "N/A" },
        { label: "DVSA mileage", value: v.dvsa_mileage || "N/A" },
        { label: "Service Notes", value: v.service_notes || "N/A" },
        { label: "Features ", value: v.features || "N/A" },
        { label: "Equipment ", value: v.equipment || "N/A" },
      ];
    },
    mappedPricingDetails() {
      const v = this.vehicle;
      return [
        { label: "CAP New", value: v.cap_new || "N/A" },
        { label: "CAP Retail", value: v.cap_retail || "N/A" },
        { label: "CAP Clean", value: v.cap_clean || "N/A" },
        { label: "CAP Average", value: v.cap_average || "N/A" },
        { label: "CAP Below", value: v.cap_below || "N/A" },
        { label: "CAP Below", value: v.cap_below || "N/A" },
        { label: "Bidding history", value: v.bidding_history || "N/A" },
        { label: "Bidding status", value: v.bidding_status || "N/A" },
        { label: "Last Bid", value: v.last_bid || "N/A" },
      ];
    },
  },
};
</script>


<style scoped>
.v-list-item {
  min-height: 40px !important;
  padding: 8px 16px !important;
}

.v-list-item-title {
  font-size: 0.95rem;
}

.bg-dark {
  background-color: #0E1B2B;
  color: white;
}

.bg-light_color {
  background-color: #000E20;
  color: white;
}

.v-list-item.rounded {
  margin-bottom: 4px;
}
</style>
