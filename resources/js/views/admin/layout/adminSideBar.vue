<template>
  <v-navigation-drawer
    class="pa-0"
    app
    dark
    color=""
    :width="68"
    v-model="themeStore.menuOpen"
  >
    <div class="v-navigation-drawer__content">
      <v-list density="compact" nav>
        <v-list-item class="d-flex" style="height: 57px;">
          <img
            v-if="menuWidth == 269"
            :src="currentLogo"
            style="width: auto; height: 40px; margin-left: -1px;"
            class="d-flex justify-center align-center"
          />
          <img
            v-else
            :src="smallCurrent"
            style="width: 40px; height: 40px;"
          />
        </v-list-item>

        <v-divider class="ps-0 pe-0"></v-divider>

        <template v-for="(item, index) in userMenu" :key="index">
          <v-list-item
            v-if="item.type == 'group'"
            class="ml-n1 mt-8"
            title=""
            :subtitle="item.label"
          >
            <v-divider class="mt-2"></v-divider>
          </v-list-item>

          <v-list-item
            v-else
            :to="item.hasOwnProperty('children') ? undefined : item.path"
            link
            :ripple="false"
            class="text-subtitle-1"
            active-class="bg-primary on-primary rounded my-active-menu hide-overlay"
            @click="item.hasOwnProperty('children') ? openSubSidebar(item) : null"
          >
            <template #prepend>
              <v-icon v-tooltip="item.label" size="25" class="ml-1">
                {{ item.icon }}
              </v-icon>
            </template>
          </v-list-item>
        </template>
      </v-list>
    </div>
  </v-navigation-drawer>

  <v-navigation-drawer
    v-model="subMenuOpen"
    permanent
    location="left"
    dark
    color=""
    :width="269"
    :style="{
      left: '68px',
      top: '',
      height: '100vh',
      position: 'fixed',
      zIndex: 5,
      transform: subMenuOpen ? 'translateX(0)' : 'translateX(-100%)',
      transition: 'transform 0.3s ease'
    }"
    class="child-sidebar"
  >
    <div class="v-navigation-drawer__content">
      <v-list density="compact" nav>
        <div
          class="d-flex justify-space-between align-center pa-4"
       
        >
          <span class="text-body-1 font-weight-medium">{{ currentGroupLabel }}</span>
          <v-icon size="24" @click="closeSubSidebar" class="cursor-pointer">
            mdi-close
          </v-icon>
          
        </div>
        <v-divider class="pa-0"></v-divider>

        <v-list-item
          v-for="child in currentChildren"
          :key="child.label"
          link
          :ripple="false"
          class="text-subtitle-1"
          :class="{ 'bg-primary on-primary rounded my-active-menu hide-overlay': $route.path === child.path }"
          @click="navigateTo(child.path)"
        >
          <template #prepend>
            <v-icon size="24">{{ child.icon }}</v-icon>
          </template>
          <template #title>
            <span class="ml-3">{{ child.label }}</span>
          </template>
        </v-list-item>
      </v-list>
    </div>
  </v-navigation-drawer>
</template>

<script>
import { useDisplay, useTheme } from "vuetify";
import { useThemeStore } from "@stores/themeStore";
import userMenu from "./adminMenu.json";
import darkLogo from "@/assets/images/header/darkfull.png";
import lightLogo from "@/assets/images/header/lightfull.png";
import darkshortLogo from "@/assets/images/header/darkshort.png";
import lightshortLogo from "@/assets/images/header/lightshort.png";

export default {
  data() {
    return {
      userMenu,
      themeStore: useThemeStore(),
      display: useDisplay(),
      vuetify: useTheme(),
      subMenuOpen: false,
      currentChildren: [],
      currentGroupLabel: ""
    };
  },
  computed: {
    menuWidth() {
      if (this.display.mdAndDown) return "269";
      return this.themeStore.menuType === "expanded" ? "269" : "68";
    },
    isDark() {
      return this.vuetify.global.name === "adminDark";
    },
    currentLogo() {
      return this.isDark ? darkLogo : lightLogo;
    },
    smallCurrent() {
      return this.isDark ? darkshortLogo : lightshortLogo;
    }
  },
  methods: {
    openSubSidebar(item) {
      this.currentChildren = item.children || [];
      this.currentGroupLabel = item.label;
      this.subMenuOpen = true;
    },
    closeSubSidebar() {
      this.subMenuOpen = false;
    },
    navigateTo(path) {
      if (path && path.trim() !== "") {
        this.$router.push(path);
      }
    }
  }
};
</script>

<style>
.my-active-menu .v-list-item__overlay {
  display: none !important;
}

.v-list-item--nav .v-list-item-title {
  font-size: 16px !important;
}

.v-navigation-drawer__content {
  overflow-y: auto;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.v-navigation-drawer__content::-webkit-scrollbar {
  display: none;
}

.child-sidebar {
  box-shadow: 4px 0 12px rgba(0,0,0,0.35) !important;
}
</style>