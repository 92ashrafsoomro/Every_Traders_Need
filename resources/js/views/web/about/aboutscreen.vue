<template>
  <main>

    <!-- HERO -->
    <section class="aboutScreen py-16 d-flex align-center  " style="margin-top: 50px; background-color: rgb(var(--v-theme-primary));">
      <v-container style="max-width:1400px;  height: 80vh;" fluid="" class=" d-flex align-center mx-auto ">

        <div class="hero-text" style="max-width: 900px;">

          <!-- Small Heading -->
          <span class="hero-about-heading text-on-primary">
            About
          </span>

          <!-- Main Heading -->
          <h1 class="text-white text-h2 font-weight-bold  mt-3" style="line-height: 1.1; ">
            Our vision is to inspire brands to thrive through exceptional content experiences
          </h1>

        </div>

        <div class="hero-image-area">
          <img src="" alt="">
        </div>

      </v-container>
    </section>

  </main>
</template>

<script>

export default {
  name: "AboutPage",
  data() {
    return {
      hoverIndex: null,
    };
  }
};
</script>

<style scoped>
.hero-about-heading {
  font-size: 18px;
  font-weight: 500;
}

.hero-image-area {
  width: 450px;
  height: 300px;
  margin-left: auto;
  background: transparent;
}

@media (max-width: 900px) {
  .hero-image-area {
    display: none;
  }

  h1 {
    font-size: 32px !important;
  }
}
/* 
@media (max-width: 600px) {
  .aboutScreen {
    
  }
} */
</style>
