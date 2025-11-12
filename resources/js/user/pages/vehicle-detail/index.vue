<template>
  <v-container fluid class="pa-0" style="min-height: 100vh;">
    <v-row dense>
      <!-- Left Filter Panel -->
      <v-col class="bg-transparent border pa-3" cols="12" md="2">
        <v-card color="transparent" flat class="h-100">
          <div class="text-caption mb-2">Filters</div>
          <div>Filter Section</div>
        </v-card>
      </v-col>

      <!-- Middle Section -->
      <v-col cols="12" md="7">
        <v-row dense>
          <!-- Tabs -->
          <v-col cols="12">
            <v-btn-toggle class="w-100" color="primary" mandatory>
              <v-btn>Vehicle Details</v-btn>
              <v-btn>Vehicle Valuation</v-btn>
            </v-btn-toggle>
          </v-col>

          <!-- Autoboli Suggestion -->
          <v-col cols="12">
            <v-card class="pa-4 bg-blue-darken-3 rounded-xl">
              <div class="text-h6 font-weight-bold mb-2">AUTOBOLI SUGGESTION</div>
              <div class="text-h4">£14,000</div>
            </v-card>
          </v-col>

          <!-- Vehicle Values -->
          <v-col cols="12">
            <v-card class="pa-4 bg-grey-darken-3 rounded-xl">
              <div class="text-h6 mb-2">Vehicle Values</div>
              <v-row>
                <v-col cols="6">Trade Values</v-col>
                <v-col cols="6">Retail Values</v-col>
              </v-row>
            </v-card>
          </v-col>

          <!-- Vehicle Info -->
          <v-col cols="12">
            <v-card class="pa-4 bg-grey-darken-3 rounded-xl">
              <div class="text-h6 mb-3">Vehicle Information</div>
              <v-img
                src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                aspect-ratio="16/9"
                class="rounded-lg"
              />
            </v-card>
          </v-col>
        </v-row>
      </v-col>

      <!-- Right Side Summary -->
      <v-col cols="12" md="3">
        <v-card class="pa-4 mb-4 bg-grey-darken-3 rounded-xl">
          <div class="text-h6 mb-2">Autoboli Predicted</div>
          <v-progress-linear model-value="90" height="10" color="blue" rounded></v-progress-linear>
        </v-card>

        <v-card class="pa-4 bg-grey-darken-3 rounded-xl">
          <div class="text-h6 mb-2">Auction Results</div>
          <div>Auction Status: Sold</div>
          <div>Win Bid: £13,150</div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { useThemeStore } from "@/stores/themeStore";

export default {
  data() {
    return {
      themeStore: useThemeStore(),
    };
  },
  mounted() {
    this.themeStore.menuType = "collapsed";
  },
};
</script>

<style scoped>
.v-card {
  color: #fff;
}
</style>
