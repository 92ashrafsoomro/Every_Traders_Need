<template>
  <v-container max-width="1400px" fluid class="bg-surface main-container mx-auto pa-lg-0 pa-md-0 pa-3">
    <div style="padding-top: 100px; padding-bottom: 100px;">
      <!-- Main Card -->
      <v-card class="mx-auto pa-8 pa-md-12 rounded-xl bg-background border-sm"
        style=" background: linear-gradient(to top, rgba(var(--v-theme-primary),0.2) 5%, transparent 80%);">
        <v-row align="center" no-gutters>
          <!-- Left Content -->
          <v-col cols="12" md="6" class="pr-md-8">
            <h2 class="text-lg-h3 text-md-h3 text-h4  font-weight-bold mb-6" style="  line-height: 1.2;">
              The Problem We Saw in the Market
            </h2>
            <p class="text-body-1 mb-6 text-whiteLight">
              Vehicle auctions move fast. Prices change daily. Information is scattered.<br>
            </p>
            <div class=" px-10 py-6  rounded-xl mb-2" style="background-color: rgb(var(--v-theme-primary),0.2);">
              <p class="text-body-1 mb-3 text-whiteLight">
                Dealers and traders often face:
              </p>

              <div class="problem-list mb-4">
                <div v-for="(item, index) in problemItems" :key="index" class="d-flex align-center mb-3 d-flex align-start">
                  <v-icon color="primary" class="mr-3 mt-1">
                    mdi-check-circle
                  </v-icon>

                  <span class="text-whiteLight text-body-2">
                    {{ item }}
                  </span>
                </div>
              </div>

              <p class="text-body-1 text-whiteLight ">Inexperience — or lack of real-time data — leads to
                costly bidding mistakes</p>
            </div>
            <p class="text-body-1 text-whiteLight  mt-4">

              We saw too many good traders losing money not because they were bad at business, but because they didn’t
              have the right information at the right time.
            </p>
          </v-col>

          <!-- Right Image -->
          <v-col cols="12" md="6" class="text-center mt-8 mt-md-0">
            <v-img :src="gridImage" alt="Confident vehicle trader presenting with confidence" max-width="500"
              class="mx-auto rounded-lg" aspect-ratio="1"></v-img>
          </v-col>
        </v-row>
      </v-card>
    </div>
  </v-container>
</template>

<script>

import gridImage from '@assets/images/about/carAuction.png';
import dealerContent from "@/json/dealer.json";

export default {
  data() {
    return {
      gridImage,
      data: dealerContent,
      problemItems: [
        'Overbidding due to incomplete market insight',
        'Missed opportunities hidden across different auction houses',
        'Losses caused by unseen condition issues or misleading valuations',
        'Hours wasted switching between platforms, spreadsheets, and guesswork'
      ]
    }
  }
}

</script>

<style scoped>
.problem-list li span {
  color: #444;
}

@media (max-width: 960px) {
  .v-row {
    flex-direction: column-reverse;
  }

  .v-col {
    text-align: center;
  }

  .problem-list li {
    justify-content: center;
  }
}
</style>