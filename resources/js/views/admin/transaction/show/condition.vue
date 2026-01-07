<template>
  <v-window-item value="condition">
    <h2 class="text-h5 mb-4">Condition</h2>

    <v-row>

      <v-col cols="12" md="6">
        <Slider :images="sliderImages" :damage_details="damagedetails" />
      </v-col>


      <v-col cols="12" md="6" class="bg-surface rounded-lg">
        <v-list-item
            v-for="(item, index) in mappedVehicleDetails"
            :key="index"
            class="px-0 rounded mx-3 my-4"
            :class="index % 2 === 0 ? 'bg-dark' : 'bg-light_color'"
            >
            <v-list-item-title class="font-weight-bold">
                {{ item.label }}
            </v-list-item-title>

            <v-list-item-subtitle class="text-right">
                <template v-if="item.label === 'Inspection Report' && item.value && item.value !== 'N/A'">
                    <a
                    :href="item.value"
                    target="_blank"
                    class="bg-primary px-3 py-3 rounded-lg text-decoration-none h-full d-inline-flex align-center justify-center text-white"
                    >
                    View Report
                    </a>
                </template>
                <template v-else>
                {{ item.value }}
                </template>
            </v-list-item-subtitle>
            </v-list-item>

      </v-col>
    </v-row>
  </v-window-item>
</template>


<script>
import Slider from "./slider.vue";

export default {
  name: "Condition",

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
    damage_details: {
        type: Array,        
        default: () => [],
    },
  },

  computed: {
    mappedVehicleDetails() {
      const v = this.vehicle;
      return [
        { label: "Grade", value: v.grade || "N/A" },
        { label: "Inspection Report", value: v.inspection_report || "N/A" },
        { label: "Other Report", value: v.other_report || "N/A" },
        { label: "Inspection Date", value: v.inspection_date || "N/A" },
        { label: "Features ", value: v.features || "N/A" },
        { label: "Equipment ", value: v.equipment || "N/A" },

      ];
    },

    sliderImages() {
      return this.images.length
        ? this.images
        : ["/placeholder.svg"];
    },
    damagedetails() {
     
        return this.damage_details || "";
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
