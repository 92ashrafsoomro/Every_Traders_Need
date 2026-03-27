<template>
  <v-navigation-drawer class="pa-0" app dark color="" :width="68" v-model="themeStore.menuOpen">
    <div class="v-navigation-drawer__content">
      <v-list density="compact" nav>
        <v-list-item class="d-flex" style="height: 57px;">
          <img v-if="menuWidth == 269" :src="currentLogo" style="width: auto; height: 40px; margin-left: -1px;"
            class="d-flex justify-center align-center" />
          <img v-else :src="smallCurrent" style="width: 40px; height: 40px;" />
        </v-list-item>

        <v-divider class="ps-0 pe-0"></v-divider>

        <div class="position-fixed d-flex align-center cursor-pointer bg-primary"
          v-if="!subMenuOpen && lastOpenedParent && $route.path !== '/admin/dashboard'"
          style="width: 20px; height: 54px; border-radius: 0 10px 10px 0; z-index: 100; left: 70px; top: 80px;"
          @click="toggleSubSidebar">
          <v-icon size="20">mdi-menu-right</v-icon>
        </div>

        <template v-for="(item, index) in userMenu" :key="index">
          <v-list-item v-if="item.type == 'group'" class="ml-n1 mt-8" title="" :subtitle="item.label">
            <v-divider class="mt-2"></v-divider>
          </v-list-item>

          <v-list-item v-else :to="item.path" link :ripple="false" class="text-subtitle-1 mt-2" :class="{
            'bg-primary on-primary rounded my-active-menu hide-overlay':
              $route.path === item.path || isChildActive(item)
          }" @click="item.children?.length ? openSubSidebar(item) : closeSubSidebar()">
            <template #prepend>
              <v-icon v-tooltip="item.label" size="25" class="ml-1">
                {{ item.icon }}
              </v-icon>
            </template>

            <template #append v-if="item.currentChildren">
              <v-icon v-show="subMenuOpen && currentGroupLabel === item.label" size="20" class="mr-1">
                mdi-menu-right
              </v-icon>
            </template>
          </v-list-item>
        </template>
      </v-list>
    </div>
  </v-navigation-drawer>

  <v-navigation-drawer v-model="subMenuOpen" location="left" :width="269" :permanent="$vuetify.display.mdAndUp"
    :temporary="$vuetify.display.smAndDown" :style="{
      transform: subMenuOpen ? 'translateX(0)' : 'translateX(-100%)',
      transition: 'transform 0.3s ease'
    }" class="sidebar_drawer">
    <div class="v-navigation-drawer__content">
      <v-list density="compact" nav>
        <div class="d-flex justify-space-between align-center pa-4">
          <span class="text-body-1 font-weight-medium">{{ currentGroupLabel }}</span>
          <v-icon size="24" @click="closeSubSidebar" class="cursor-pointer">
            mdi-close
          </v-icon>
        </div>
        <v-divider class="pa-0 mt-1"></v-divider>

        <v-list-item v-for="child in currentChildren" :key="child.label" link :to="child.path" :ripple="false"
          class="text-subtitle-1 mt-2"
          :class="{ 'bg-primary on-primary rounded my-active-menu hide-overlay': $route.path === child.path }"
          @click="navigateTo(child.path)">
          <template #title>
            <span class="ml-3">{{ child.label }}</span>
          </template>
        </v-list-item>
      </v-list>
    </div>
  </v-navigation-drawer>
  <!-- <div class="d-lg-none d-md-none d-flex smallNav">
<div class="v-navigation-drawer__content">
      <v-list density="compact" nav>
        <div class="d-flex justify-space-between align-center pa-4">
          <span class="text-body-1 font-weight-medium">{{ currentGroupLabel }}</span>
          <v-icon size="24" @click="closeSubSidebar" class="cursor-pointer">
            mdi-close
          </v-icon>
        </div>
        <v-divider class="pa-0 mt-1"></v-divider>

        <v-list-item v-for="child in currentChildren" :key="child.label" link :to="child.path" :ripple="false"
          class="text-subtitle-1 mt-2"
          :class="{ 'bg-primary on-primary rounded my-active-menu hide-overlay': $route.path === child.path }"
          @click="navigateTo(child.path)">
          <template #title>
            <span class="ml-3">{{ child.label }}</span>
          </template>
        </v-list-item>
      </v-list>
    </div>
  </div> -->
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
      currentGroupLabel: "",
      lastOpenedParent: null           // floating arrow ke liye yaad rakhein ge
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
    toggleSubSidebar() {
      this.subMenuOpen = !this.subMenuOpen;
    },

    openSubSidebar(item) {
      this.currentChildren = item.children || [];
      this.currentGroupLabel = item.label;
      this.subMenuOpen = true;
      this.lastOpenedParent = item;
    },

    closeSubSidebar() {
      this.subMenuOpen = false;
    },

    navigateTo(path) {
      if (path && path.trim() !== "") {
        this.$router.push(path);
      }
    },

    isChildActive(item) {
      if (!item.children) return false;
      return item.children.some(child => this.$route.path === child.path);
    }
  }
};
</script>

<style scoped>
.my-active-menu .v-list-item__overlay {
  display: none !important;
}

.v-list-item--nav .v-list-item-title {
  font-size: 16px !important;
}

.sidebar_drawer {
  /* left: 67px; */
  height: '100vh';
  position: fixed;
  z-index: 5;
}

.v-navigation-drawer__content {
  overflow-y: auto;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

@media (max-width: 786px) {

  .sidebar_drawer {
    position: absolute;
    left: 0;
    z-index: 1006;
  }

}

.v-navigation-drawer__content::-webkit-scrollbar {
  display: none;
}
</style>