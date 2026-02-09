<template>
  <v-window-item value="vehicle">
    <h2 class="text-h5 mb-4">Vehicle details</h2>

    <v-row>

      <v-col cols="12" md="6">
        <Slider :images="sliderImages" :auction="true" :vehicle="vehicle" />
      </v-col>


      <v-col cols="12" md="6" class="bg-surface rounded-lg">
        <v-list class="mx-2 mr-4 my-4">
          <v-list-item
            v-for="(item, index) in mappedVehicleDetails"
            :key="index"
            class="px-0 rounded"
            :class="index % 2 === 0 ? 'bg-dark' : 'bg-light_color'"
          >
            <v-list-item-title class="font-weight-bold">
              {{ item.label }}
            </v-list-item-title>

            <v-list-item-subtitle class="text-right">
              {{ item.value }}
            </v-list-item-subtitle>
          </v-list-item>
        </v-list>
      </v-col>
    </v-row>
  </v-window-item>
</template>


<script>
import Slider from "./slider.vue";

export default {
  name: "Vehicledetail",

  components: {
    Slider,
  },

  props: {
    vehicle: {
      type: Object,
      required: true,
    },
    images: {
      type: Array,
      default: () => [],
    },
  },

  computed: {
    mappedVehicleDetails() {
      const v = this.vehicle;
      return [
        { label: "Title", value: v.title || "N/A" },
        { label: "Make", value: v.make_id || "N/A" },
        { label: "Model", value: v.model_id || "N/A" },
        { label: "Variant", value: v.variant_id || "N/A" },
        { label: "Derivative", value: v.derivative || "N/A" },
        { label: "Make ID", value: v.make_id || "N/A" },
        { label: "Model ID", value: v.model_id || "N/A" },
        { label: "Variant ID", value: v.variant_id || "N/A" },
        { label: "Vehicle Type", value: v.vehicleType?.name || "N/A" },
        { label: "Vehicle ID", value: v.vehicle_id || "N/A" },
        { label: "Body ID", value: v.body_id || "N/A" },
        { label: "Year", value: v.year || "N/A" },
      ];
    },

    sliderImages() {
      return this.images.length
        ? this.images
        : ["/placeholder.svg"];
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
