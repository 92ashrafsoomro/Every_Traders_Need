<template>
  <v-container fluid class="bg-background main-container ">
    <div class="pt-16 pb-16 mx-auto " style="max-width: 1400px;">
        <v-row align="center" >
          <!-- Left Content -->
          <v-col cols="12" md="6" class="mt-8 mt-md-0">
            <div color="primary" class=" bg-primary rounded-xl" height="520" max-width="520" elevation="10">
              <v-row class="fill-height ma-0" align="center" justify="end">
                <v-col cols="12" class=" pr-0">
                  <v-img :src="dashboardImage" alt="Autoboli dashboard showing organized vehicle auction data"
                    class="rounded-lg ml-3" height="500" contain></v-img>
                </v-col>
              </v-row>
            </div>
          </v-col>

          <!-- Right content -->
          <v-col cols="12" md="6" class="pr-md-8 pl-10 ">
            <h2 class="text-h4 font-weight-bold mb-6">
              Why Autoboli Exists
            </h2>
            <p class="text-body-1 mb-6 text-body">
              Autoboli was created to give dealers and traders a clear advantage at auction.<br>
              Our goal is simple:<br>
              <strong>Turn auction data into clarity, confidence, and profit.</strong>
            </p>

            <p class="text-body-1 mb-6 text-body">
              We aggregate and analyze data from 30+ UK auction houses, combining:
            </p>

            <ul class="mb-8 pa-0">
              <li v-for="(item, i) in features" :key="i" class="mb-3 d-flex align-start">
                <v-icon color="primary" class="mr-3 mt-1">mdi-check-circle</v-icon>
                <span class="text-body-2">{{ item }}</span>
              </li>
            </ul>

            <p class="text-body-1 text-body-1 font-weight-medium">
              So you can compare before you bid, not after you lose.
            </p>
          </v-col>


        </v-row>
      </div>

  </v-container>
</template>

<script>
import dashboardImage from '@/assets/images/reauction/reauction.png'

export default {
  data() {
    return {
      dashboardImage,
      features: [
        'Live and historical auction results',
        'Vehicle inspection and condition data',
        'CAP valuations and market benchmarks',
        'Autoboli’s own intelligent pricing insights'
      ]
    }
  }
}
</script>

<style scoped>
/* Sirf zaroori spacing ke liye minimal scoped style - baaki sab Vuetify */
.main-container {
  padding-top: 80px;
  padding-bottom: 80px;
}
</style>