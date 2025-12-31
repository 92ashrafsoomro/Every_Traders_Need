<template>
  <v-app-bar
    class="px-3 px-sm-5"
    flat
    :elevation="scrolled ? 4 : 0"
    :class="scrolled ? 'bg-surface' : 'bg-transparent'"
  >
    <template v-slot:prepend>
      <v-btn to="/">
        <v-img width="130" :src="currentLogo"></v-img>
      </v-btn>
    </template>

    <template v-slot:append>
      <v-btn
        @click="themeStore.toggleThemeMode(vuetify)"
        v-if="vuetify.global.name === 'adminDark'"
        icon="mdi-lightbulb-off"
      />
      <v-btn
        @click="themeStore.toggleThemeMode(vuetify)"
        v-if="vuetify.global.name === 'adminLight'"
        icon="mdi-lightbulb-on"
      />
      <v-btn variant="tonal" size="40" to="/" class="rounded-xl" :class="scrolled ? 'bg-background' : ''">
        <v-icon size="25">mdi-home</v-icon>
      </v-btn>
    </template>
  </v-app-bar>
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
