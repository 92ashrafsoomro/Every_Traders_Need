<template>
  <v-window-item value="specifications" >
    <h2 class="text-h5 mb-4">Specifications</h2>

    <v-row >
      <v-col cols="12" md="6" class="bg-surface rounded-lg mt-2 ">
        <v-list class="mx-4 mr-4 my-4">
          <v-list-item
            v-for="(item, index) in leftDetails"
            :key="'left-' + index"
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


      <v-col cols="12" md="6" class="bg-surface rounded-lg mt-2">
        <v-list class="mx-4 mr-4 my-4">
          <v-list-item
            v-for="(item, index) in rightDetails"
            :key="'right-' + index"
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
export default {
  name: "specifications",
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
        { label: "Doors", value: v.doors ?? "N/A" },
        { label: "Seats", value: v.seats ?? "N/A" },
        { label: "Fuel Type", value: v.fuel_type ?? "N/A" },
        { label: "Transmission", value: v.transmission ?? "N/A" },
        { label: "CC", value: v.cc ?? "N/A" },
        { label: "Colour", value: v.color ?? "N/A" },
        { label: "Keys", value: v.keys ?? "N/A" },
        { label: "Euro Status", value: v.euro_status ?? "N/A" },
        { label: "D.O.R", value: v.dor ?? "N/A" },
        { label: "Body Type", value: v.vehicleType?.name ?? "N/A" },
        { label: "Reg", value: v.reg ?? "N/A" },
        { label: "Former Keepers", value: v.former_keepers ?? "N/A" },
        { label: "Mileages", value: v.reg ?? "N/A" },
        { label: "Mileage Warranted", value: v.mileage_warranted ?? "N/A" },
        { label: "MOT Expiry Date", value: v.mot_expiry_date ?? "N/A" },
        { label: "MOT Due", value: v.mot_due ?? "N/A" },
        { label: "V5", value: v.v5 ?? "N/A" },
        { label: "VAT Status", value: v.vat_status ?? "N/A" },
        { label: "Non Runner", value: v.nonrunner ?? "N/A" },
        { label: "Drivetrain", value: v.drivetrain ?? "N/A" },
      ];
    },

    leftDetails() {
      const half = Math.ceil(this.mappedVehicleDetails.length / 2);
      return this.mappedVehicleDetails.slice(0, half);
    },

    rightDetails() {
      const half = Math.ceil(this.mappedVehicleDetails.length / 2);
      return this.mappedVehicleDetails.slice(half);
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
