<template>

    <v-navigation-drawer class="pa-0" app dark :width="menuWidth" v-model="themeStore.menuOpen" @mouseenter="hoverOpen"
        @mouseleave="hoverClose">

        <v-list density="compact" nav>
            <!-- Logo -->
            <v-list-item style="height:57px">
                <img v-if="menuWidth == 269" :src="currentLogo" style="height:40px" />
                <img v-else :src="smallCurrent" style="height:40px" />
            </v-list-item>

            <v-divider class="ps-0 pe-0"></v-divider>

            <template v-for="(item, index) in userMenu" :key="index">
                <!-- Group Title -->
                <v-list-item v-if="item.type == 'group'" active-class="bg-primary on-primary rounded-sm my-active-menu"
                    :subtitle="item.label">
                    <v-divider class="mt-2"></v-divider>
                </v-list-item>

                <!-- Parent With Children -->
                <v-list-item v-else-if="item.children" @click="openSubMenu(item)"
                    active-class="bg-primary on-primary rounded my-active-menu hide-overlay"
                    class="d-flex align-center text-body-2" :class="{
                        'bg-primary on-primary': isChildActive(item)
                    }">
                    <v-icon v-tooltip="item.label" size="25" class="ml-1">{{ item.icon }}</v-icon>
                    <span v-if="menuWidth == 269" class="ml-3">{{ item.label }}</span>
                </v-list-item>

                <!-- Normal Link -->
                <v-list-item v-else :to="item.path" link
                    active-class="bg-primary on-primary  rounded my-active-menu hide-overlay"
                    class="d-flex align-center text-body-2">
                    <v-icon size="25" class="ml-1">{{ item.icon }}</v-icon>
                    <span v-if="menuWidth == 269" class="ml-3">{{ item.label }}</span>
                </v-list-item>
            </template>



        </v-list>

    </v-navigation-drawer>

    <v-navigation-drawer v-model="showSubMenu" location="left" width="230" temporary style="margin-top: 70px;"
        :disable-resize-watcher="true">
        <v-list density="compact">
            <v-list-item v-for="child in subMenuItems" :key="child.label" :to="child.path" link :class="{
                'bg-primary rounded my-active-menu text-white mx-2 my-2':
                    $route.path === child.path
            }" class="d-flex align-center">
                <v-icon>{{ child.icon }}</v-icon>
                <span class="ml-3">{{ child.label }}</span>
            </v-list-item>
        </v-list>
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
            isHovering: false,
            activeMenu: null,
            showSubMenu: false,
            subMenuItems: [],
        };
    },
    computed: {
        menuWidth() {


            return 68;
        },
        isDark() {
            return this.vuetify.global.name === "adminDark";
        },
        currentLogo() {
            return this.isDark ? darkLogo : lightLogo;
        },
        smallCurrent() {
            return this.isDark ? darkshortLogo : lightshortLogo;
        },
    },
    methods: {
        hoverOpen() {
            this.isHovering = true;
        },
        hoverClose() {
            this.isHovering = false;
        },
        openSubMenu(item) {
            if (this.activeMenu === item.label) {
                this.showSubMenu = !this.showSubMenu;
            } else {
                this.subMenuItems = item.children;
                this.showSubMenu = true;
            }
            this.activeMenu = item.label;
        },
        isChildActive(item) {
            if (!item.children) return false;
            return item.children.some(child => child.path === this.$route.path);
        },
    },
};
</script>

<style>
.v-navigation-drawer__content {
    overflow-y: auto;
    scrollbar-width: none;
}

.v-navigation-drawer__content::-webkit-scrollbar {
    display: none;
}

.v-list-item:hover {
    background: rgb(var(--v-theme-primary)) !important;
    color: white;

}

.bg-primary {
    background: rgb(var(--v-theme-primary)) !important;
}
</style>