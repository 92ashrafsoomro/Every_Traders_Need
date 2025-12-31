<template>
  <v-container fluid class="pattern-wrapper position-relative  pa-0"
    style="  background-color: rgb(var(--v-theme-surface)); overflow: hidden;">
    <!-- BACKGROUND -->
    <div class="pattern-bg"></div>

    <!-- CONTENT -->
    <v-container class="content d-flex align-center" style="min-height: 800px;">
      <v-container max-width="1400px">
        <v-row justify="center">
          <v-col cols="12" lg="10">
            <div class="d-flex flex-wrap justify-center">

              <div> <img :src="logo" alt="" class="mr-4" style="max-width:200px">
              </div>
              <div>
                <h2 class="text-lg-h3 text-md-h3 text-h5  font-weight-bold d-flex align-center mb-8 text-whiteLight"> at
                  a Glance</h2>
              </div>

            </div>





            <div class="d-flex justify-center mt-10">
              <ul style="list-style:none; padding:0; gap:16px;">
                <div
                  class="d-flex flex-column flex-sm-row align-center justify-center justify-md-start text-center mb-4">
                  <div class="d-lg-flex d-md-flex d-none  glass-card-icon" style=" background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                      mdi-check-circle
                    </v-icon>
                  </div>
                  <li>

                    <span class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card">30+ UK auction houses
                      covered</span>
                  </li>
                </div>

                <div
                  class="d-flex flex-column flex-sm-row align-center justify-center justify-md-start text-center mb-4">
                  <div class="d-lg-flex d-md-flex d-none  glass-card-icon" style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                      mdi-check-circle
                    </v-icon>
                  </div>
                  <li>
                    <span class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card">Live</span> <span
                      class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card">upcoming</span> <span
                      class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card"> and historical auction
                      data</span>
                  </li>
                </div>
                <div
                  class="d-flex flex-column flex-sm-row align-center justify-center justify-md-start text-center mb-4">
                  <div class="d-lg-flex d-md-flex d-none  glass-card-icon  justify-center text-center"
                    style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                      mdi-check-circle
                    </v-icon>
                  </div>
                  <li>
                    <span class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card">Vehicle valuation</span> <span
                      class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card">comparison & reauction
                      tracking</span>
                  </li>
                </div>
                <div
                  class="d-flex flex-column flex-sm-row align-center justify-center justify-md-start text-center mb-4">
                  <div class="d-lg-flex d-md-flex d-none  glass-card-icon" style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                      mdi-check-circle
                    </v-icon>
                  </div>
                  <li> <span class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card"> VIN & registration-based
                      vehicle
                      intelligence</span>
                  </li>
                </div>
                <div
                  class="d-flex flex-column flex-sm-row align-center justify-center justify-md-start text-center mb-4">
                  <div class="d-lg-flex d-md-flex d-none  glass-card-icon" style="background-color: rgb(var(--v-theme-primary),0.2); ">
                    <v-icon color="primary" size="25">
                      mdi-check-circle
                    </v-icon>
                  </div>
                  <li>
                    <span class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card">Built for speed</span> <span
                      class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card">accuracy</span> <span
                      class="text-lg-h6 text-body-1  text-whiteLight pa-4 glass-card"> and profitability</span>
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
.pattern-bg {
  position: absolute;
  inset: 0;
  /* background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px); */
  background-color: rgb((var(--v-theme-surface)));
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
  border: 1px solid rgb(var(--v-theme-border));
  box-shadow: 0 8px 80px rgba(var(--v-theme-primary), 0.3);
  overflow: hidden;
  width: auto;
  max-width: 100%;
}

.glass-card-icon {
  display: inline-block;
  margin-right: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 66px;
  width: 66px;
  margin-bottom: 16px;
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-radius: 16px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  box-shadow: 0 8px 80px rgba(var(--v-theme-primary), 0.3);
}

</style>
