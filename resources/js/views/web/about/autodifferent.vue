<template>
  <div style="padding-top: 100px; padding-bottom: 100px;" class="bg-surface">
    <v-container elevation style="max-width: 1400px; margin: auto;">
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
          <v-card class="rounded-lg border h-100" >

            <v-img height="200" src="https://cdn.vuetifyjs.com/docs/images/cards/purple-flowers.jpg" cover />

            <v-card-text class="pa-8 bg-background h-100">
              <h1 class="text-h6 pb-2 font-weight-bold">{{ item.title }}</h1>
              <div>{{ item.desc }}</div>

              <!-- <v-btn
                    v-if="item.hasButton"
                    color="primary"
                  >
                    {{ item.buttonText }}
                  </v-btn> -->
             
                <AppButton text="Explore" to="/" v-if="item.hasButton"/>
               
           


            </v-card-text>

          </v-card>
        </v-col>

      </v-row>
    </v-container>
  </div>
</template>

<script>
import autoboliCardContent from '@/json/different.json'
import AppButton from '../component/AppButton.vue';
export default {
  name:"AutoBoliDifference",
    components:{

AppButton
    },
  data() {
    
    return {

      title: autoboliCardContent.title,
      subtitle: autoboliCardContent.subtitle,
      cards: autoboliCardContent.cards
    }
  }
}
</script>

<style scoped>
.custom-btn {
  font-weight: bold;
  padding-left: 30px;
  padding-right: 30px;
  /* padding: 0px 10px ; */
  border-radius: 30px;
  height: 46px !important;

}
.arrow-btn {
  background: white !important;
  height: 46px !important;
}
.icon-bold::before {
  font-weight: 700;
}
</style>