<template>

  <v-container fluid class="bg-surface " style="min-height: 70vh;">
    <v-container style="max-width:1500px">
      <v-row align="center">

        <!-- LEFT : TEXT -->
        <v-col cols="12" md="6" class="text-center text-md-left">
          <h1 class="text-h5 text-md-h3 font-weight-bold text-white mb-6">
            Smarter Vehicle Auction <br />
            Insights - All in One Place
          </h1>

          <p class="text-body-1 text-light_text_on mb-8 w-100 w-md-75">
            Stay ahead of the market with real-time UK vehicle auction data,
            transparent valuations, and powerful tools designed for dealers.
          </p>

          <div class="d-flex ga-2 pb-4 justify-center justify-md-start">
            <span>We Check:</span>
            <v-icon v-for="i in 4" :key="i">mdi-car-sports</v-icon>
          </div>

          <div class="d-flex ga-4 justify-center justify-md-start">
            <v-btn color="primary" size="large">Explore Auctions</v-btn>
            <v-btn variant="outlined" size="large">Start Free Trial</v-btn>
          </div>
          <div class="w-100  mt-10">
            <p>A carVertical report can uncover:</p>
            <div class="w-100 text-light_text_on mt-5 ">
              <ul class="d-flex ga-2 w-100 mb-2 " style="list-style:none">
                <li v-for="(item, i) in featuresCol1" :key="i" class="d-flex align-center ga-1"> <v-icon size="18"
                    color="primary">mdi-check</v-icon> {{ item }} </li>
              </ul>
              <ul class="d-flex ga-2 w-100 mb-2" style="list-style:none">
                <li v-for="(item, i) in featuresCol2" :key="i" class="d-flex align-center ga-1"> <v-icon size="18"
                    color="primary">mdi-check</v-icon> {{ item }} </li>
              </ul>
              <ul class="d-flex ga-2 w-100" style="list-style:none">
                <li v-for="(item, i) in featuresCol3" :key="i" class="d-flex align-center ga-1"> <v-icon size="18"
                    color="primary">mdi-check</v-icon> {{ item }} </li>
              </ul>
            </div>
          </div>

        </v-col>

        <!-- RIGHT : MOCKUP -->
        <v-col cols="12" md="6" class="d-none d-md-flex justify-end">
          <div class="d-flex flex-column align-end">

            <!-- TOP CARD -->
            <v-sheet rounded="lg" elevation="6" width="600" height="260" class="mb-n10 mr-n6 overflow-hidden bg-white">
              <!-- <v-img :src="screenRight" cover height="100%" /> -->
            </v-sheet>

            <!-- BOTTOM CARD -->
            <v-sheet rounded="lg" elevation="4" width="600" height="260" class="overflow-hidden bg-white">
              <!-- <v-img :src="logoImage" cover height="100%" /> -->
            </v-sheet>

          </div>
        </v-col>


      </v-row>
    </v-container>
  </v-container>

</template>

<script>
import screenRight from '@/assets/images/reauction/Reauction.png'
import logoImage from '@/assets/images/logo/logo.png'
import avatar1 from '@/assets/images/avatar/avatar1.png'
import avatar2 from '@/assets/images/avatar/avatar2.png'
import avatar3 from '@/assets/images/avatar/avatar3.png'

export default {
  name: 'HeroSection',
  data() {
    return {
      screenRight,
      logoImage,
      avatar1,
      avatar2,
      avatar3,
      featuresCol1: [
        'Recorded images',
        'Damage',
        'Theft records',
        'Mileage rollbacks'
      ],
      featuresCol2: [

        'Specs & equipment',
        'Emission taxes',
        'Market value',
        'Safety ratings',
      ],
      featuresCol3: [

        'Financial restrictions',
        'Natural disaster exposure',
        'and more...',
      ],
    }
  }
}
</script>

<style scoped>
.dashboard-mockup {
  position: absolute;
  top: 90px;
  right: 0;
  height: 600px;
  /* overflow: hidden; */
  pointer-events: none;
  overflow: hidden;
}

@media (max-width: 1400px) {

  .dashboard-mockup {
    position: absolute;
    top: 90px;
    right: 0;
    width: 600px;
    height: 600px;
    /* overflow: hidden; */
    pointer-events: none;
    overflow: hidden;
  }

}

@media (max-width: 1024px) {
  .dashboard-mockup {
    position: absolute;
    top: 90px;
    right: 0;
    display: none;
    height: auto;
    pointer-events: none;
  }
}

@media (max-width: 600px) {
  .dashboard-mockup {

    right: 10px;
    background-color: aliceblue;
  }
}
</style>