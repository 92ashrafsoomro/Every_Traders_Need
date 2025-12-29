<template>
  <v-container fluid class="pattern-wrapper pa-0">
    <!-- BACKGROUND -->
    <div class="pattern-bg"></div>

    <!-- CONTENT -->
    <v-container class="content d-flex align-center" style="min-height: 800px;">
      <v-container max-width="1400px">
        <v-row justify="center">
          <v-col cols="12" lg="10">
            <h2 class="text-h3 d-flex ga-4 justify-center font-weight-bold mb-8 text-white">
              <img :src="logo" width="200" alt=""> at a Glance
            </h2>

            <v-row>
              <v-col
                v-for="item in items"
                :key="item"
                cols="12"
                md="6"
              >
              
                  <div class="text-h6 text-white pa-4 glass-card">
                    {{ item }}
                  </div>
               
              </v-col>
            </v-row>

          </v-col>
        </v-row>
      </v-container>
    </v-container>
  </v-container>
</template>

<script>
  import logo from'@/assets/images/logo/logo.png'
export default {
  name: "AutoboliAtGlance",
  data() {
    return {
      items: [
        "30+ UK auction houses covered",
        "Live, upcoming, and historical auction data",
        "Vehicle valuation, comparison & reauction tracking",
        "VIN & registration-based vehicle intelligence",
        "Built for speed, accuracy, and profitability"
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

  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px); 
  border-radius: 16px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  box-shadow: 0 8px 80px rgba(var(--v-theme-primary),0.3); 
  overflow: hidden;
}

</style>
