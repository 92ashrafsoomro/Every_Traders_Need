<template>
  <section class="bg-background py-20 overflow-hidden relative pa-14 min-vh-100">
    <v-container style="padding-top: 80px; padding-bottom: 80px;" class="relative z-10">
      <div class="d-flex justify-content-center align-center">
        <div class="images">
          <div class=""><img :src="leftSideImage" alt="Left Image" /></div>

        </div>

        <div class="text-center max-w-3xl mx-auto">
          <!-- Centered Heading -->
          <h1 class="text-h6 text-lg-h4 text-md-h5 font-weight-bold text-white mb-6">
            {{ bidSmarterData.title }}
          </h1>

          <!-- Centered Paragraph -->
          <p class="text-subtitle-1 text-light_text_on mb-14 mx-auto" style="max-width: 600px;">
            {{ bidSmarterData.paragraph }}
          </p>

          <!-- Centered Button -->
          <v-btn color="primary" size="large" class="px-8 text-body-2 text-md-subtitle-1 font-weight-bold">
            {{ bidSmarterData.button }}
          </v-btn>

        </div>
        <div class="images">
          <div class=""><img :src="leftSideImage" alt="Right Image" /></div>
        </div>
      </div>

      <!-- Left & Right Images -->
    </v-container>

  </section>
</template>

<script>
import leftSideImage from '@/assets/images/tabs/footerimg.png'
import bidSmarterData from "@/json/bidsmarter.json"
export default {
  data() {
    return {
      leftSideImage,
      bidSmarterData
    }
  }
}
</script>

<style scoped>
/* .images {
  display: flex;
  width: 100%;
  justify-content: space-between;
  margin-top: -160px;
} */

.left {
  rotate: 90deg;
}

@media (max-width: 600px) {
  .images {
    justify-content: space-between !important;
    margin-left: -30px;
    margin-top: 0;
  }

  .images img {
    width: 150px;
  }
}
</style>