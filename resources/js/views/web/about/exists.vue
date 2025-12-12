<template >
    <div style="max-width: 1500px; padding-top: 80px; padding-bottom: 80px; margin: auto;">
      <!-- Heading -->
      <div class="text-center my-12">
        <h2 class="text-h3 font-weight-bold text-white mb-4">
          Why Autoboli Exists
        </h2>
        <p class="text-subtitle-1 text-grey-lighten-1">
          Most auction buyers face the same frustrating challenges:
        </p>
      </div>

      <!-- Cards Grid -->
      <v-row >
        <v-col
          v-for="(item, index) in existsCardData"
          :key="index"
          cols="12"
          sm="6"
          md="4"

        >
          <v-card elevation="0"
            :class="['card pa-6 position-relative elevation-8', item.highlight ? 'bg-danger darken-2' : 'bg-surface']"
          >    
          <div class="text-body-1 text-text_light" style="height: 70px; border-left: 5px solid white; ">
              <p class="ml-10 pa-2" >{{ item.label }}</p>
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
