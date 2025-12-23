<template>
  <div class="button d-flex justify-space-between bg-primary align-center  pa-3  " style=" min-width: 150px; max-width: 200px; border-radius: 40px;">
    <div class="text ml-2 mr-2">
      {{ text }}
    </div>
    <div class="icon bg-white rounded-xl pa-1"> <v-icon>
        {{ icon }}
      </v-icon></div>

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
