<template>
  <v-container fluid class="pa-0" >
    <!-- Top Logos Section -->
    <v-row class="justify-center  py-8 mt-10" style="background: #f8f9fa;">
      <v-col class="text-center ">
        <div class="d-flex flex-wrap gap-10 justify-center align-center logo-container">
          <img :src="zoom" alt="Zoom" height="40" class="logo-item" />
          <img :src="microsoft" alt="Microsoft" height="40" class="logo-item" />
          <img :src="teamviewer" alt="TeamViewer" height="40" class="logo-item" />
          <img :src="google" alt="Google" height="40" class="logo-item" />
          <img :src="slack" alt="Slack" height="50" class="logo-item" />
        </div>
      </v-col>
    </v-row>

    <!-- Main Vision Section -->
    <v-container class="my-16" style="max-width: 1300px;">
      <v-row align="center" class="px-4">
        <!-- Left Column - Vision Text -->
        <v-col cols="12" lg="6">
          <v-chip color="primary" label class="mb-4 ">
            Vision
          </v-chip>
          <h1 class="text-h3 font-weight-bold mb-6">
            Our Vision.
          </h1>
          <div class="text-body-1 text-grey-darken-2 mb-6">
            <p class="mb-4">
              At Autoboli, our vision is simple: To empower dealers and traders with transparent, real-time auction data and insights that help them make smarter, faster, and more profitable decisions.
            </p>
            <p>
              We believe in transforming the automotive trade industry with clarity, innovation, and intelligence.
            </p>
          </div>
        </v-col>

        <!-- Right Column - Highlight Card -->
        <v-col cols="12" lg="5" offset-lg="1">
          <v-card
            elevation="12"
            rounded="xl"
            class="pa-10 text-start bg-white"
            dark
          >
            <h2 class="text-h4 " style="line-height: 1.3; font-weight: bolder;">
              <span class="font-weight-bold text-primary">Save people  </span> <br />
                 <span class="font-weight-bold text-primary"> time</span>   by making<br />
              the world more<br />
              <span class=" white--text">productive</span>.
            </h2>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<script>
import zoom from '@/assets/images/logo/zoom.png'
import microsoft from '@/assets/images/logo/Microsoft-Logo.png'
import teamviewer from '@/assets/images/logo/teamviewer.png'
import google from '@/assets/images/logo/google-logo.png'
import slack from '@/assets/images/logo/slack.png' 

export default {
  name: 'VisionSection',
  data() {
    return {
      zoom,
      microsoft,
      teamviewer,
      google,
      slack
    }
  }
}
</script>

<style scoped>
.logo-container {
  gap: 10rem;
  margin-top: 100px;

}

.logo-item {
  opacity: 0.75;
  transition: all 0.3s ease;
  width: 120px;
  height: auto;
}

.logo-item:hover {
  opacity: 1;
  transform: translateY(-4px);
}

/* Responsive adjustments */
@media (max-width: 960px) {
  .logo-container {
    gap: 2rem;
  }
}

@media (max-width: 600px) {
  .logo-container {
    gap: 1.5rem;
    flex-direction: column;
  }
  .logo-item {
    margin: 0.5rem 0;
  }
}
</style>