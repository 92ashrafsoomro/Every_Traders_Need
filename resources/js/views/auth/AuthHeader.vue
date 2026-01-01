<template>
<div class=" pt-2  d-flex align-center position-absolute justify-space-between px-6"
      style="z-index: 1000; width: 100%;">
      <div class="w-50 d-flex">
       <router-link to="/"> <img :src="currentLogo" height="30px" alt="logo" /></router-link>
      </div>

      <div class="ga-2 d-flex">
        <v-btn @click="themeStore.toggleThemeMode(vuetify)" v-if="vuetify.global.name === 'adminDark'"
          icon="mdi-lightbulb-off" class="rounded-lg border" elevation="0" variant="text"/>
        <v-btn @click="themeStore.toggleThemeMode(vuetify)" v-if="vuetify.global.name === 'adminLight'"
          icon="mdi-lightbulb-on"  class="rounded-lg border" elevation="0" variant="text"/>

                <v-btn icon="mdi-home" to="/" class="rounded-lg border " variant="text" elevation="0" />

      </div>
    </div>
</template>

<script>
import { useThemeStore } from "@stores/themeStore";
import { useTheme } from "vuetify";
import darkLogo from "@/assets/images/header/darkfull.png";
import lightLogo from "@/assets/images/header/lightfull.png";

export default {
  name: "AuthHeader",
  data() {
    return {
      themeStore: useThemeStore(),
      vuetify: useTheme(),
      scrolled: false,
    };
  },
  computed: {
    isDark() {
      return this.vuetify.global.name === "adminDark";
    },
    currentLogo() {
      return this.isDark ? darkLogo : lightLogo;
    },
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
  },
  beforeUnmount() {
    window.removeEventListener("scroll", this.handleScroll);
  },
  methods: {
    handleScroll() {
      this.scrolled = window.scrollY > 50; // change threshold as needed
    },
  },
};
</script>

<style scoped>
.bg-background {
  background-color: rgba(var(--v-theme-primary), 0.1); /* adjust color/opacity */
  transition: background-color 0.3s;
}
</style>
