<template>
  <div style="padding-top: 100px; padding-bottom: 100px;" class="bg-surface">
    <v-container elevation style="max-width: 1500px; margin: auto;">
      <div class="text-center mb-12">
        <h2 class="text-h6 text-lg-h4 text-md-h5 font-weight-bold text-white mb-4">
          {{ title }}
        </h2>

        <p class="text-subtitle-1 text-grey-lighten-1 max-w-800 mx-auto">
          {{ subtitle }}
        </p>
      </div>

      <v-row>
        <v-col v-for="(item, index) in cards" :key="index" cols="12" sm="6" md="4">
          <v-card class="rounded-xl">

            <v-img height="200" src="https://cdn.vuetifyjs.com/docs/images/cards/purple-flowers.jpg" cover />

            <v-card-text class="pa-10 bg-background">
              <h1 class="text-h6 pb-5 font-weight-bold">{{ item.title }}</h1>
              <div>{{ item.desc }}</div>

              <!-- <v-btn
                    v-if="item.hasButton"
                    color="primary"
                  >
                    {{ item.buttonText }}
                  </v-btn> -->
              <v-btn class="custom-btn" color="primary" v-if="item.hasButton" elevation="0"
                target="_blank">
                Explore

                <v-btn href="https://google.com" class="arrow-btn text-primary" icon>
                  <v-icon size="32">mdi-arrow-top-right</v-icon>
                </v-btn>

              </v-btn>


            </v-card-text>

          </v-card>
        </v-col>

      </v-row>
    </v-container>
  </div>
</template>

<script>
import autoboliCardContent from '@/json/different.json'

export default {
  data() {
    return {
      title: autoboliCardContent.title,
      subtitle: autoboliCardContent.subtitle,
      cards: autoboliCardContent.cards
    }
  }
}
</script>

<style>
.custom-btn {
  position: relative;
  border-radius: 30px;
  height: 46px !important;

}

.arrow-btn {
  position: absolute !important;
  left: 105px;
  background: white !important;
  height: 45px !important;
}
</style>