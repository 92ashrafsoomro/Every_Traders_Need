<template>  
<!-- Background Wrapper -->
  <div class="w-100 h-100 bg-surface pb-8" style="position: absolute;">
    <div class="pattern-bg"></div>
    <div class="position-relative pt-5" style="max-width: 1400px; z-index: 10">
      <slot />
    </div>
  </div>
  <v-container
    fluid
    class="bg-surface d-flex align-center justify-center"
    style="min-height: 100vh;"
  >

    <div style="max-width: 900px;" class="mx-auto w-100">
      <v-row align="center" justify="center">
        <v-col cols="12" md="8">
          <v-card
            class="pa-8 rounded-xl border"
            elevation="0"
          >
            <v-row align="center">
              <!-- LEFT -->
              <v-col cols="12" md="6">
                <h1
                  class="text-h1 font-weight-bold text-primary"
                  style="line-height: 1;"
                >
                  404
                </h1>

                <h3 class="text-h5 mt-2">
                  Page not found
                </h3>

                <p class="text-body-2 text-medium-emphasis mt-3">
                  The page you’re looking for doesn’t exist or has been moved.
                  Please check the URL or return to the dashboard.
                </p>

                <div class="mt-6 d-flex ga-3">
                  <v-btn
                    color="primary"
                    variant="flat"
                  >
                   <router-link to="/autoboli" style="text-decoration: none; color: white;"> Go Back</router-link>
                  </v-btn>


                </div>
              </v-col>

              <!-- RIGHT -->
              <v-col cols="12" md="6" class="text-center">
             <img :src="logo" alt="" srcset="" sizes="cover">
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </v-container>

</template>

<script>
import logo from "@/assets/images/logo/logo.png"
export default {
    data(){
        return{
           
            logo
        }
    }
}
</script>

<!-- <script setup>
    import navbar from '../web/layout/navbar.vue';
    import footer from '../web/layout/footer.vue';
const refresh = () => {
    console.log('Refreshing page...');
    window.location.reload();
};

const getHelp = () => {
    console.log('Opening support...');
    alert('Support contact feature would open here!');
};
</script> -->

<style scoped>
.fill-height {
    min-height: 100vh;
    background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
}

.v-card {
    transition: all 0.3s ease;
}

.v-btn {
    transition: transform 0.2s ease;
}

.v-btn:hover {
    transform: translateY(-2px);
}

svg {
    max-width: 100%;
    height: auto;
}
</style>