<template>
  <div class="bg-background d-flex align-center" style="min-height: 800px;">
    <div class="mx-auto d-flex flex-column flex-md-row align-center justify-center ga-16" style="max-width: 1400px;">
      <!-- IMAGE -->
      <div class="rightImage">
        <img :src="TrustedPartnerImage" class="trusted-img" alt="Trusted Partner" />
      </div>

      <!-- CONTENT -->
      <div class="leftContent pl-10 pr-10 pl-lg-0 pl-md-0 text-center text-lg-start ">
        <v-chip class="mb-4 text-primary  " style="border-radius: 0px 20px 0px 0px; padding: 6px 16px;">
          Why Autoboli
        </v-chip>

        <div>
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
          <div class=" justify-center justify-lg-start item-center item-lg-start text-center d-flex">
            
        <div class=" mt-4 ml-n10" style="width: 100px;">
          <AppButton text="About Us" to="/about" />

        </div>
          </div>
        </div>




      </div>

  
    </div>

  </div>
</template>


<script>
import TrustedPartnerImage from '@assets/images/hero/HomepageImageTrusted.png'
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
  width: 500px;
  height: auto;
  object-fit: contain;
  animation: rotateImage 2s infinite ease-in-out;
  max-width: 100%;
}

@keyframes rotateImage {
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
}
.rightImage,
.leftContent {
  flex: 1 1 100%;
}

@media (min-width: 960px) {
  .rightImage,
  .leftContent {
    flex: 1 1 50%; 
    max-width: 700px;
  }
}
@media (max-width: 960px) {
  
  .trusted-img {
  width: 300px;}
}

</style>