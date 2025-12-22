<template>
  <v-window-item value="Servicehistory">
    <h2 class="text-h5 mb-4">Service History</h2>

    <v-row>
      <v-col cols="12" md="11">
        <v-list class="pa-0">
          <v-list-item
            v-for="(item, index) in mappedVehicleDetails"
            :key="index"
            class="px-0 rounded"
            :class="index % 2 === 0 ? 'bg-dark' : 'bg-light_color'"
          >
            <v-list-item-title class="font-weight-bold">{{ item.label }}</v-list-item-title>
            <v-list-item-subtitle
              class="text-right"
              :class="item.textColor ? item.textColor : ''"
            >
              {{ item.value }}
            </v-list-item-subtitle>
          </v-list-item>
        </v-list>
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
