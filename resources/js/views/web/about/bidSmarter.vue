<template>
  <v-container fluid style="padding: 100px 0px 100px 0px !important;">
    <div class="mx-auto  overflow-hidden position-relative" style="
        max-width: 1400px;
        height: 700px;
        background: linear-gradient(
      to 
     top, rgba(var(--v-theme-primaryDark)) 5%, rgba(var(--v-theme-primary)) 80%
    ); border: 1px solid rgb(var(--v-theme-border)); border-radius: 70px;
        border-radius: 40px;
      ">

      <div class="d-flex flex-column align-center text-center position-relative h-100">


        <div class="text-white px-4 flex-grow-0" style="z-index: 2; margin-top: 80px;">
          <h1 class="text-h3 font-weight-bold mb-4">
            Bid Smarter. Buy Better.
          </h1>
          <p class="text-body-1 font-weight-medium mb-8">
            Trade with Confidence. Autoboli — Turning auction data into winning decisions.
          </p>



        </div>
        <div class="d-flex justify-center  mb-2">

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
        <div class="flex-grow-1"></div>


        <div class="w-100 position-relative" style="z-index: 1; ">

          <div class="position-absolute w-100 h-100" style="
              background: linear-gradient(to top, rgba(var(--v-theme-primary), 0.5) 5%, transparent 50%);
              border-radius: 40px;
              pointer-events: none;
            "></div>


          <img :src="dashboardImage" alt="Autoboli Dashboard" class="mx-auto  px-2"
            style="overflow: hidden;  width: 100%; max-width: 1200px; display: block; height: auto; margin-top: 40px;" />
        </div>
      </div>
    </div>
  </v-container>
</template>
<script>
import dashboardImage from '@/assets/images/reauction/Reauction.png'

export default {
  name: 'HeroSection',

  data() {
    return {
      dashboardImage: dashboardImage
    }
  }
}
</script>
<style scoped>
/* Hover effect */
.hover-lift {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.cursor-pointer {
  cursor: pointer;
}

.h-100 {
  height: 100%;
}
</style>