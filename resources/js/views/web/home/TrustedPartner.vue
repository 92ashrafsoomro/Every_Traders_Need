<template>
  <div class="bg-surface d-flex align-center mt-lg-12 " style="min-height: 900px;">
    <div class="mx-auto d-flex justify-center flex-column flex-md-row ga-16 mb-10 mb-lg-0 mb-md-0 " style=" max-width: 1400px;">
      <!-- IMAGE -->
      <div class="rightImage  d-flex ">
        <img :src="TrustedPartnerImage" class="trusted-img" alt="Trusted Partner" />
      </div>

      <!-- CONTENT -->
      <div class="leftContent   text-center text-lg-start ">
        <v-chip class="mb-4 text-primary  " style="border-radius: 0px 20px 0px 0px; padding: 6px 16px;">
          Our Vision
        </v-chip>

        <div>
          <h1 class="text-h5 text-md-h3 mb-6 font-weight-bold">
            At Autoboli, our vision is simple
          </h1>

          <p class="mb-6 text-light_text_on text-body-1">
            To empower dealers and traders with transparent, real-time auction data and insights that help them make
            smarter, faster, and more profitable decisions.
          </p>

          <p class="text-light_text_on text-body-1">
            We believe in transforming the automotive trade industry with clarity, innovation, and intelligence.
          </p>
          <div class="d-flex flex-wrap justify-center justify-lg-start justify-md-start  mt-4 ga-4"  >
                                  <div v-for="item in [
                                    'Know the real value before bidding',
                                    'Spot risky vehicles early',
                                    'Compare auction houses side by side',
                                    'Plan ahead with live auction schedules'
                                ]" :key="item" class="d-flex align-center px-4 rounded-lg" style="background-color: rgb(var(--v-theme-primary), 0.1); height:60px; width: 280px;">
                                    <v-icon color="primary" class="mr-2">mdi-check-circle</v-icon>
                                    <span class="text-body-2">{{ item }}</span>
                                </div>
                                
          <!-- <div class=" justify-center justify-lg-start item-center item-lg-start text-center">
               <div class="mt-5 border-sm pa-5 rounded-lg "
                               >
                                <p class=" text-body-1 font-weight-bold text-start mr-6">Autoboli helps you:</p>
                                
                                </div>
                            </div> -->
  
          </div>
        </div>
        <div class="d-flex justify-center justify-lg-start mt-4 ">
          <router-link to="about" style="text-decoration: none;">
            <div class="button d-flex justify-space-between bg-primary align-center  pa-3  "
              style=" min-width: 150px; max-width: 200px; border-radius: 40px;">
              <div class="text ml-2 mr-2">
                About us
              </div>
              <div class="icon bg-white rounded-xl pa-1"> <v-icon>
                  mdi-arrow-top-right
                </v-icon></div>

            </div>
          </router-link>
        </div>



      </div>


    </div>

  </div>
</template>


<script>
import TrustedPartnerImage from '@/assets/images/about/helping.png'
import AppButton from '../component/AppButton.vue'

export default {
  name: "TrustedPartner",
  components: {
    AppButton
  },
  data() {
    return {
      TrustedPartnerImage
    }
  }
}
</script>


<style scoped>
.trusted-img {
  width: 600px;
  height: auto;
  object-fit: contain;
  animation: rotateImage 2s infinite ease-in-out;
  max-width: 100%;
}

/* @keyframes rotateImage {
  0% {
    transform: scale(1);
    opacity: 1;
  }

  50% {
    transform: scale(1.2);
    opacity: 0.1;
  }

  100% {
    transform: scale(1);
    opacity: 0.16;
  }
} */



@media (min-width: 960px) {

  .rightImage,
  .leftContent {
    flex: 1 1 50%;
    max-width: 700px;
  }
}

@media (max-width: 960px) {

  .trusted-img {
    width: 300px;
  }
}
</style>