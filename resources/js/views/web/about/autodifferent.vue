<template>
    <div class="bg-surface pa-16">
  <v-container style="max-width: 1500px; margin: auto;" >
        <div class="text-center mb-12">
        <h2 class="text-h3 text-md-h2 font-weight-bold text-white mb-4">
        What Makes Autoboli Different
        </h2>
        <p class="text-subtitle-1 text-grey-lighten-1 max-w-800 mx-auto">
         Unlike traditional valuation tools or static vehicle lookup platforms, Autoboli gives you
        </p>
      </div>
    <v-row  >

      <v-col
        v-for="(msg, index) in messages"
        :key="index"
        cols="12"
        sm="6"
        md="4"
        
      >
        <v-card class="h-100 rounded-xl">

          <v-img
            height="200"
            src="https://cdn.vuetifyjs.com/docs/images/cards/purple-flowers.jpg"
            cover
          >
            
          </v-img>

          <v-card-text style="background-color: rgb(275, 275, 275 , 0.1);">
          

            <v-timeline align="start" density="compact" >
              <v-timeline-item>
                <strong>{{ msg.title }}</strong>
                <div>{{ msg.desc }}</div>

                <v-btn
                  v-if="msg.hasButton"
                  size="small"
                  color="primary"
                  variant="flat"
                >
                  {{ msg.buttonText }}
                </v-btn>

              </v-timeline-item>
            </v-timeline>
          </v-card-text>

        </v-card>
      </v-col>

    </v-row>
  </v-container>
  </div>
</template>


<script setup>
const messages = [
  {
    title: "Spot Auction Dropouts",
    desc: "Identify vehicles that didn't sell the first time and investigate the reason."
  },
  {
    title: "Spot Auction Dropouts",
    desc: "Identify vehicles that didn't sell the first time and investigate the reason."
  },
  {
    title: "Spot Auction Dropouts",
    desc: "Identify vehicles that didn't sell the first time and investigate the reason."
  },
  {
    title: "Spot Auction Dropouts",
    desc: "Identify vehicles that didn't sell the first time and investigate the reason."
  },
  {
    title: "Spot Auction Dropouts",
    desc: "Identify vehicles that didn't sell the first time and investigate the reason."
  },
  {
    title: "Spot Auction Dropouts",
    desc: "",
    hasButton: true,
    buttonText: "Explore"
  }
];
</script>

<style scoped>
/* Perfect 2px gap between cards */
.gap-2px {
  gap: 2px !important;
}
</style>
