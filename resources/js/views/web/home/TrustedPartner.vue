<template>
  <div class="bg-background d-flex align-center" style="min-height: 800px;">
    <div class="mx-auto d-flex flex-column flex-md-row align-center justify-center ga-16" style="max-width: 1400px;">
      <!-- IMAGE -->
      <div class="rightImage">
        <img :src="TrustedPartnerImage" class="trusted-img" alt="Trusted Partner" />
      </div>

      <!-- CONTENT -->
      <div class="leftContent text-center">
        <v-chip class="mb-4 text-primary  " style="border-radius: 0px 20px 0px 0px; padding: 6px 16px;">
          Why Autoboli
        </v-chip>

        <h1 class="text-h5 text-md-h3 mb-6 font-weight-bold">
          Your Trusted Partner For Smarter Vehicle <br class="d-none d-md-block" />
          Trading
        </h1>

        <p class="mb-6 text-light_text_on">
          Lorem ipsum dolor sit amet consectetur adipisicing elit...
        </p>

        <p class="text-light_text_on">
          Lorem ipsum dolor sit amet consectetur adipisicing elit...
        </p>
        <div>
        <v-chip class="mb-4 text-primary d-flex " style="border-radius: 2px 20px 10px 0px; padding: 6px 16px;">
          Why Autoboli
        </v-chip>
</div>
        <!-- <div class="mt-10 w-50">
                    <v-btn class="w-100 h-75 pa-4"  variant="flat" color="primary" rounded="">
                      <span class="text-capitalize" >View More</span>
                    </v-btn>
                    <v-btn class="w-100 h-75 pa-4" variant="flat" color="primary" rounded="">
                          <span class="text-capitalize">View Less</span>
                    </v-btn>

                </div> -->
      </div>

    </div>
  </div>
</template>


<script>
import TrustedPartnerImage from '@assets/images/hero/HomepageImageTrusted.png'
// import AppButton from '../component/AppButton.vue'

export default {
  name: "TrustedPartner",
  components: {
    // AppButton
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
  width: 100%;
  max-width: 600px;
  height: auto;
  object-fit: contain;
}

.rightImage,
.leftContent {
  flex: 1 1 100%;
  max-width: 100%;
}

@media (min-width: 960px) {

  .rightImage,
  .leftContent {
    flex: 1 1 50%;
    max-width: 700px;
  }
}
</style>