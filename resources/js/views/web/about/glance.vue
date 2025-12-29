<template>
  <v-container fluid class="pattern-wrapper pa-0">
    <!-- BACKGROUND -->
    <div class="pattern-bg"></div>

    <!-- CONTENT -->
    <v-container class="content d-flex align-center" style="min-height: 800px;">
      <v-container max-width="1400px">
        <v-row justify="center">
          <v-col cols="12" lg="10">
            <div class="d-flex flex-column align-center justify-center">
              <h2 class="text-h3 font-weight-bold d-flex align-center  mb-8 text-white">
                <img :src="logo" width="300" alt="" class="mr-4"> at a Glance
              </h2>
            </div>



            <div class="d-flex justify-center mt-10">
              <ul style="list-style:none; padding:0; gap:16px;">
                <div class="d-flex "> <div class="d-flex  glass-card-icon" style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                    mdi-check-circle
                  </v-icon>
                 </div>
                  <li>

                    <span class="text-h6 text-white pa-4 glass-card">30+ UK auction houses covered</span>
                  </li>
                </div>

                <div class="d-flex"> 
                  <div class="d-flex  glass-card-icon" style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                    mdi-check-circle
                  </v-icon>
                 </div>
                  <li>
                    <span class="text-h6 text-white pa-4 glass-card">Live</span> <span
                      class="text-h6 text-white pa-4 glass-card">upcoming</span> <span
                      class="text-h6 text-white pa-4 glass-card"> and historical auction data</span>
                  </li>
                </div>
                <div class="d-flex"> <div class="d-flex  glass-card-icon" style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                    mdi-check-circle
                  </v-icon>
                 </div>
                  <li>
                    <span class="text-h6 text-white pa-4 glass-card">Vehicle valuation</span> <span
                      class="text-h6 text-white pa-4 glass-card">comparison & reauction tracking</span>
                  </li>
                </div>
                <div class="d-flex"> <div class="d-flex  glass-card-icon" style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                    mdi-check-circle
                  </v-icon>
                 </div>
                  <li> <span class="text-h6 text-white pa-4 glass-card"> VIN & registration-based vehicle
                      intelligence</span>
                  </li>
                </div>
                <div class="d-flex">  <div class="d-flex  glass-card-icon" style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                    mdi-check-circle
                  </v-icon>
                 </div>
                  <li>
                    <span class="text-h6 text-white pa-4 glass-card">Built for speed</span> <span
                      class="text-h6 text-white pa-4 glass-card">accuracy</span> <span
                      class="text-h6 text-white pa-4 glass-card"> and profitability</span>
                  </li>
                </div>
              </ul>
            </div>

          </v-col>
        </v-row>
      </v-container>
    </v-container>
  </v-container>
</template>

<script>
import logo from '@/assets/images/logo/logo.png'
export default {
  name: "AutoboliAtGlance",
  data() {
    return {
      items: [
        "30+ UK auction houses covered", "Live",
        "upcoming", "and historical auction data",
        "Vehicle valuation ", " comparison & reauction tracking",
        "VIN & registration-based vehicle intelligence",
        "Built for speed ", " accuracy ", "and profitability"
      ],
      logo
    }
  }
}
</script>

<style scoped>
.pattern-wrapper {
  position: relative;
  overflow: hidden;
  background-color: #031428;
}

.pattern-bg {
  position: absolute;
  inset: 0;
  background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px);
  background-size: 16px 16px;
  opacity: 0.35;
  z-index: 0;
}

.content {
  position: relative;
  z-index: 1;
}

.glass-card {
  display: inline-block;
  padding: 16px;
  margin-bottom: 16px;
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-radius: 16px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  box-shadow: 0 8px 80px rgba(var(--v-theme-primary), 0.3);
  overflow: hidden;
  width: auto;
  max-width: 100%;
}

.glass-card-icon {
  display: inline-block;
  /* padding: 10px; */
  margin-right: 20px;
  display: flex; 
align-items: center;      
  justify-content: center;
  height: 66px;
  width:  66px;
  margin-bottom: 16px;
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-radius: 16px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  box-shadow: 0 8px 80px rgba(var(--v-theme-primary), 0.3);

}
</style>
