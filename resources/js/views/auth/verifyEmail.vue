<template>
  <!-- Background Wrapper -->
  <div class="w-100 h-100 bg-surface pb-8" style="position: absolute;">
    <div class="pattern-bg"></div>
    <div class="position-relative pt-5" style="max-width: 1400px; z-index: 10 ;  overflow: hidden;">
      <slot></slot>
    </div>
  </div>

  <v-app class="bg-surface">
    <!-- Decorative Shape -->
    <div
      class="position-absolute bottom-0 left-0 right-0 h-50 bg-primary"
      style="z-index: 0; border-radius: 0 300px 0 0;"
    ></div>

      <AuthHeader></AuthHeader>
    <!-- Main -->
    <v-main class="h-screen d-flex align-center justify-center pa-4 pa-lg-0" style="z-index: 10;">
      <v-card
        color="background"
        class="pa-lg-10 pa-6 mx-auto border-sm "
        rounded="lg"
        style="width: 480px;"
      >
        <!-- Title -->
        <v-card-item>
          <v-card-title
            class="text-center text-h5 text-md-h4 font-weight-bold"
          >
          
            Verify Code
            <p class="text-body-2 mt-1">
              Enter the 6-digit code sent to your email
            </p>
             <p class="text-body-2 pa-2 rounded-sm mb-2 mt-2" style="background-color: rgb(var(--v-theme-primary),0.2);">huzaifaabdulrab2@gmail.com</p>
         
          </v-card-title>

        </v-card-item>

        <v-divider />

        <!-- Content -->
        <div class="mt-6">
       

          <!-- OTP Inputs -->
          <v-row justify="center" class="mb-6" dense>
            <v-col
              v-for="(digit, index) in otp"
              :key="index"
              cols="2"
            >
              <v-text-field
                v-model="otp[index]"
                maxlength="1"
                variant="outlined"
                density="comfortable"
                color="primary"
                class="text-center   otp-input "
                style="border: none;"
            
             
              
              />
            </v-col>
          </v-row>

          <!-- Button -->
          <v-btn
            color="primary"
            variant="flat"
            block
            size="large"
            class="text-capitalize rounded-sm"
          >
           <router-link to="resetpassword" style="text-decoration: none; color: white;">Verify</router-link>
          </v-btn>

          <!-- Resend -->
          <div class="text-center mt-4 text-body-2">
            Didn’t receive code?
            <span class="text-primary font-weight-medium cursor-pointer">
              Resend
            </span>
          </div>
        </div>
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
    import AuthHeader from "./AuthHeader.vue";

export default {
    name: "verify",
    components: {
        AuthHeader
    },
    data() {
    return {
      otp: ['', '', '', '', '', ''],
    };
  },
  methods: {
    
  },
};
</script>


<style scoped>
.otp-input input {
  text-align: center;
  font-size: 22px;
  font-weight: 600;
}
.cursor-pointer {
  cursor: pointer;
}
</style>
