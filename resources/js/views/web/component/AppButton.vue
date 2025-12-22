<template>
  <div class="d-flex align-center w-100"><v-btn
    class="app-btn  h-50 pa-4 d-flex justify-space-between  align-center"

    variant="flat"
    color="primary"
    :to="to"
    :href="href"
    target="_blank"
    rounded
  >
    <span class="text-capitalize text-subtitle-2 ">
      {{ text }}
    </span>

  
  </v-btn><v-btn icon color="white" class="circle-btn" :href="href" target="_blank" style="width: 40px; height: 40px; min-width: 30px; border-radius: 50%; "> <v-icon class="text-primary font-weight-bold"> {{ icon }} </v-icon> </v-btn>

</div>
</template>

<script>
export default {
  name: "AppButton",
  props: {
    text: {
      type: String,
      default: "About Us"
    },
    icon: {
      type: String,
      default: "mdi-arrow-top-right"
    },
    to: {
      type: [String, Object],
      default: null
    },
    href: {
      type: String,
      default: null
    }
  }
}
</script>

<style scoped>
.app-btn {
width: 120px;
height: 50px;
  font-weight: 500;
}
</style>
