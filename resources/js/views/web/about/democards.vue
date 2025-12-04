<template>
  <v-container max-width="1300px">
    <v-row no-gutters class="">

      <v-col
        v-for="(msg, index) in messages"
        :key="index"
        cols="12"
        sm="6"
        md="4"
      >
        <v-card class="h-100">

          <v-img
            height="200"
            src="https://cdn.vuetifyjs.com/docs/images/cards/purple-flowers.jpg"
            cover
          >
            <v-toolbar color="transparent">
              <template #prepend>
                <v-btn icon="$menu"></v-btn>
              </template>

              <v-toolbar-title>{{ msg.title }}</v-toolbar-title>

              <template #append>
                <v-btn icon="mdi-dots-vertical"></v-btn>
              </template>
            </v-toolbar>
          </v-img>

          <v-card-text>
            <div class="font-weight-bold ms-1 mb-2">Today</div>

            <v-timeline align="start" density="compact">
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
