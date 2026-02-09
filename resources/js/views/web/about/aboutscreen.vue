<template>
  <main>
    <!-- HERO -->
    <section class="aboutScreen d-flex"
      style="margin-top: 50px; background-color: rgb(var(--v-theme-primary)); min-height: 80vh;">
      <v-container fluid class="d-flex flex-column ga-4 flex-md-row align-items-center justify-center mx-auto"
        style="max-width: 1400px;">
        <!-- TEXT -->
        <div class="hero-text d-flex flex-column justify-center text-start" style="max-width: 700px;">
          <span class="hero-about-heading text-on-primary">About</span>
          <h1 class="text-h5 text-lg-h3   text-md-h3 font-weight-bold  mb-6">
            Our vision is to inspire brands to thrive through exceptional content experiences
          </h1>

          <p class="text-body-1  mb-8 w-100  d-flex text-center text-lg-start justify-center">
            Stay ahead of the market with real-time UK vehicle auction data,
            transparent valuations, and powerful tools designed for dealers.
          </p>
          <div class="d-flex flex-wrap ga-4 justify-center  justify-lg-start">
            <router-link to="auctionschedule" style="text-decoration: none ; ">
              <v-btn color="white" size="large" class="text-capitalize text-surface">Explore Auctions</v-btn>
            </router-link>

            <router-link to="pricing" style="text-decoration: none ;">
              <v-btn variant="outlined" size="large" class="text-capitalize text-surface">Start Free Trial</v-btn>
            </router-link>
          </div>
        </div>


        <!-- IMAGE -->
        <div class="hero-image-area d-flex justify-center mt-8 mt-md-0" style="max-width: 700px;">
          <img :src="aboutImage" alt="About Autoboli" class="hero-image" />
        </div>
      </v-container>
    </section>
  </main>
</template>

<script>
import aboutImage from '@/assets/images/about/AboutAutoboli.png'

export default {
  name: "AboutPage",
  data() {
    return {
      aboutImage
    }
  }
}
</script>

<style scoped>
/* HERO IMAGE */
.hero-image {
  max-width: 100%;
  height: auto;
  object-fit: contain;
}

/* RESPONSIVE ADJUSTMENTS */
@media (max-width: 960px) {
  .hero-text {
    margin-bottom: 2rem;
  }

  .text-md-left {
    text-align: center !important;
  }
}
</style>
