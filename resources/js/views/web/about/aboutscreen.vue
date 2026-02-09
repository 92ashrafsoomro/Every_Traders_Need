<template>
  <main>
    <!-- HERO -->
    <section
      class="aboutScreen d-flex"
      style="margin-top: 50px; background-color: rgb(var(--v-theme-primary)); min-height: 80vh;"
    >
      <v-container
        fluid
        class="d-flex flex-column flex-md-row align-items-center justify-center mx-auto"
        style="max-width: 1400px; height:80vh;"
      >
        <!-- TEXT -->
        <div class="hero-text text-center text-md-left" style="max-width: 700px;">
          <span class="hero-about-heading text-on-primary">About</span>
          <h1
            class="text-white text-h2 font-weight-bold mt-3"
            style="line-height: 1.2;"
          >
            Our Vision
            At Autoboli, our vision is simple:
            To empower dealers and traders with transparent, real-time auction data and insights that help them make
            smarter, faster, and more profitable decisions.
            <br /><br />
            We believe in transforming the automotive trade industry with clarity, innovation, and intelligence.
          </h1>
        </div>

        <!-- IMAGE -->
        <div
          class="hero-image-area d-flex justify-center mt-8 mt-md-0"
          style="max-width: 700px;"
        >
          <img :src="aboutImage" alt="About Autoboli" class="hero-image" />
        </div>
      </v-container>
    </section>
  </main>
</template>

<script>
import aboutImage from '@/assets/images/about/Exists.png'

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
