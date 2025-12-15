<template>
  <v-container fluid class="pa-0 bg-surface">
    <v-sheet color="#0d1b2a" class="bg-surface  d-flex flex-column align-center justify-center mx-auto"  style="max-width: 1400px;">
      <div class="text-center mb-8 mt-16">
        <h1  class="text-h3 mb-6" style="font-weight: bold;">Before vs. After Using Autoboli</h1>
        <h2 class="text-h5 text-white">Before Autoboli – The Old Way</h2>
      </div>

      <v-container fluid class="px-4 px-md-8">
  <v-row justify="center">
    <v-col cols="12" md="10" lg="8">
      <v-row>
        
        <!-- Left Column -->
        <v-col cols="12" sm="6">
          <div
            v-for="n in 5"
            :key="'left-' + n"
            class="mb-4"
          >
            <v-card
              class="pa-3 pa-md-4 rounded-lg d-flex align-center"
              style="background-color: #b91c1c30;"
              elevation="4"
            >
              <v-icon
                color="red"
                size="32"
                size-md="40"
                class="mr-3 mr-md-4"
              >
                mdi-close-thick
              </v-icon>

              <span class="text-white text-body-2 text-md-subtitle-1">
                Hours wasted checking multiple auction websites
              </span>
            </v-card>
          </div>
        </v-col>

        <!-- Right Column -->
        <v-col cols="12" sm="6">
          <div
            v-for="n in 5"
            :key="'right-' + n"
            class="mb-4"
          >
            <v-card
              class="pa-3 pa-md-4 rounded-lg d-flex align-center"
              style="background-color: #b91c1c30;"
              elevation="4"
            >
              <v-icon
                color="red"
                size="32"
                size-md="40"
                class="mr-3 mr-md-4"
              >
                mdi-close-thick
              </v-icon>

              <span class="text-white text-body-2 text-md-subtitle-1">
                Hours wasted checking multiple auction websites
              </span>
            </v-card>
          </div>
        </v-col>

      </v-row>
    </v-col>
  </v-row>

<v-divider class="mx-auto mt-12 w-100" color="rgba(255,255,255)"></v-divider>
    
</v-container>
</v-sheet>
  
  </v-container>
</template>

<script>
export default {
  name: 'BeforeAfterAutoboli',
}
</script>

<style scoped>
.min-vh-100 {
  min-height: 100vh;
}
</style>