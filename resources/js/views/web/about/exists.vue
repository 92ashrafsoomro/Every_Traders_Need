<template>
  <div style="max-width: 1500px; margin: auto;">
    <!-- Heading -->
    <div class="text-center mb-12">
      <h2 class="text-h3 font-weight-bold text-white mb-4">
        Why Autoboli Exists
      </h2>
      <p class="text-subtitle-1 text-grey-lighten-1">
        Most auction buyers face the same frustrating challenges:
      </p>
    </div>

    <!-- Cards Grid -->
    <v-row  class="">
      <v-col
        v-for="(item, index) in existsCardData"
        :key="index"
        cols="12"
        sm="6"
        md="4"
      >
        <v-card
          :class="['card pa-6  position-relative elevation-8', item.highlight ? 'bg-danger darken-2' : 'bg-surface']"
        >
          <div class=" bg-white  border-lg border-danger  " style="position: absolute; left: 20px; top: 20px; bottom: 16px; width: 6px; height: 100px;     border-radius: 0 4px 4px 0;"></div>
          <div class="text-body-1 text-white ml-4 mt-4 " style="height: 90px;">
            {{ item.label }}
          </div>
        </v-card>
      </v-col>
    </v-row>

</div>
 

</template>

<script>
import existsCardData from '@/json/about'
import card from './card.vue';

export default {
    name: "WhyAutoboliSection",
    data() {
    return {
      existsCardData,
      card
    }}
};
</script>

<style scoped>



hero-gradient {

  position: relative;
  overflow: hidden;
}


@media (max-width: 960px) {
  .v-card {
    margin: 0 20px;
    padding: 40px 24px !important;
  }
  .text-h4 { font-size: 2rem !important; }
  .text-h6 { font-size: 1.1rem !important; }
}



@media (max-width: 600px) {
  
}</style>
