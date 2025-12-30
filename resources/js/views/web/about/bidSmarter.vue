<template>
  <v-container class="py-16">
    <div class="mx-auto d-flex  flex-column  align-center text-center" style="
        max-width: 1400px;
        height: 800px;
           background: linear-gradient(
      to bottom,
      rgb(var(--v-theme-primary)),
      rgb(var(--v-theme-primaryDark))
    ); border: 1px solid rgb(var(--v-theme-border)); border-radius: 70px;">
      <!-- TOP IMAGE -->
      <!-- <img
        :src="heroImage"
        class="mb-6 mt-16"
        width="120"
        height="120"
        alt="Logo"
      /> -->


      <!-- TEXT -->
      <div class="text-white mb-10 " style="margin-top: 100px;">
        <h5 class="text-h2 font-weight-bold">Bid Smarter. Buy Better.</h5>
        <p class="text-body-1 mt-2 font-weight-bold">
          Trade with Confidence. Autoboli — Turning auction data into winning decisions.
        </p>

        <div>
        </div>
        <div class="d-flex justify-center mt-10 mb-2">

          <router-link to="/register" style="text-decoration: none;">
            <div class="button d-flex justify-space-between bg-white align-center  pa-1  hoverEffect "
              style=" min-width: 150px; max-width: 200px; border-radius: 40px;">

              <div class="text ml-2 mr-2 font-weight-bold">
                Get Started
              </div>
              <div class="icon bg-primary rounded-xl pa-1"> <v-icon>
                  mdi-arrow-top-right
                </v-icon></div>

            </div>
          </router-link>
        </div>

      </div>

      <!-- BOTTOM IMAGE (FIXED WITH PADDING) -->
      <div class="bottom-image-wrapper">
        <div class="hero-overlay"></div>
        <img :src="newlogo" class="responsive-img" alt="Logo" />
      </div>

    </div>
  </v-container>
</template>


<script>
import logo from '@/assets/images/logo/auto1.png'
import newlogo from '@/assets/images/reauction/Reauction.png'
import AppButton from '../component/AppButton.vue';
export default {
  components: {
    AppButton
  },
  data() {
    return {
      heroImage: logo,
      newlogo,
      AppButton
    }
  }
}
</script>

<style scoped>
.bottom-image-wrapper {
  padding-left: 10px;
  position: relative;
  padding-right: 10px;
  width: 100%;
  overflow: hidden;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(var(--v-theme-primaryDark), 0.8) 2%, transparent 70%);
  z-index: 1;
  border-radius: 70px;
}

.responsive-img {
  position: relative;
  z-index: 0;
  border-radius: 10px;
  width: 100%;
  max-width: 1200px;
  height: auto;
}
.hoverEffect:hover {
  transform: translateY(-4px);
  transition: 0.2s ease-in-out;
}
</style>