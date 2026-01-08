<template>
  <v-window-item value="additionalinformation">
    <v-row dense>
      <!-- Additional Information Card -->
      <v-col cols="12" md="6">
        <v-card class="pa-4 rounded-lg elevation-2">
          <h2 class="text-h5 mb-4">Additional Information</h2>
          <v-list class="pa-0">
            <v-list-item
              v-for="(item, index) in parsedAdditionalInfo"
              :key="'info-' + index"
              class="px-0 rounded"
              :class="index % 2 === 0 ? 'bg-dark' : 'bg-light_color'"
            >
              <v-list-item-title class="font-weight-bold">{{ item.label }}</v-list-item-title>
              <v-list-item-subtitle class="text-right">{{ item.value }}</v-list-item-subtitle>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>

      <!-- Tyres Condition Card -->
      <v-col cols="12" md="6">
        <v-card class="pa-4 rounded-lg elevation-2">
          <h2 class="text-h5 mb-4">Tyres Condition</h2>
          <v-list class="pa-0">
            <v-list-item
              v-for="(tyre, index) in parsedTyres"
              :key="'tyre-' + index"
              class="px-0 rounded"
              :class="index % 2 === 0 ? 'bg-dark' : 'bg-light_color'"
            >
              <v-list-item-title class="font-weight-bold">{{ tyre.key }}</v-list-item-title>
              <v-list-item-subtitle class="text-right">{{ tyre.value }}</v-list-item-subtitle>
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
parsedAdditionalInfo() {
  try {
    // Remove extra backslashes and trim
    const raw = this.vehicle.additional_information || '{}';
    const cleanJson = raw.replace(/\\+/g, '').trim();

    const info = JSON.parse(cleanJson);
    const interior = info.Interior || {};

    return Object.keys(interior).map(key => ({
      label: key,
      value: interior[key] || 'N/A',
    }));
  } catch (e) {
    console.error('Failed to parse additional_information:', e);
    return [];
  }
},



    parsedTyres() {
      if (!this.vehicle.tyres_condition) return [];
      return this.vehicle.tyres_condition.split(',').map(item => {
        const parts = item.split('||').map(p => p.trim());
        return {
          key: parts[0] || '',
          value: parts[1] || '',
        };
      });
    }
  },
};
</script>
<style scoped>
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

