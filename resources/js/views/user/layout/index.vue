<template>
    <v-app>
        <Sidebar />
        <v-app-bar elevation="0" app color="" class="d-flex align-center justify-space-between elevation-3 border-b"
            style="height: 70px;">
            <v-app-bar-nav-icon class="d-lg-none" @click="themeStore.toggleMenu()"></v-app-bar-nav-icon>
            <div elevation="1" class="logoType d-none d-lg-flex align-center justify-center rounded-circle border"
                style="width: 30px; height: 30px;" :class="{ 'bg-primary': isHovered }" @mouseenter="isHovered = true"
                @mouseleave="isHovered = false">
                <v-icon class="d-none d-lg-inline-flex justify-center align-center" size="default"
                    :icon="isMenuOpen ? 'mdi-menu-left' : 'mdi-menu-right'" @click="toggleMenu"></v-icon>
            </div>
            <v-toolbar-title class="d-none d-sm-inline pl-1">
                <p class="text-h6">Dashboard</p>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-row class="pr-2 ga-5" align="center" justify="end" no-gutters>
                <div class="d-flex align-center justify-space-around mr-3">
                    <!-- Fullscreen -->
                    <v-col cols="auto">
                        <v-sheet color="" class="d-flex align-center justify-center rounded pa-2 border"
                            :class="{ 'bg-background': hoverFullscreen }" @mouseenter="isHover = true"
                            @mouseleave="hoverFullscreen = false">
                            <v-icon icon="mdi-fullscreen" class="cursor-pointer" @click="toggleFullScreen"></v-icon>
                        </v-sheet>
                    </v-col>

                    <!-- Theme Dropdown -->
                    <v-col cols="auto" class="ml-n3">
                        <v-sheet color="" class="d-flex align-center justify-center rounded border"
                            :class="{ 'bg-background': hoverTheme }" @mouseenter="hoverTheme = true"
                            @mouseleave="hoverTheme = false">
                            <ThemeDropdown />
                        </v-sheet>
                    </v-col>

                    <!-- Notification Dropdown -->
                    <v-col cols="auto" class="ml-n3">
                        <v-sheet color="" class="d-flex align-center justify-center rounded border"
                            :class="{ 'bg-background': hoverNotification }" @mouseenter="hoverNotification = true"
                            @mouseleave="hoverNotification = false">
                            <Notificationdropdown class="test" />
                        </v-sheet>
                    </v-col>
                </div>
                <div class="border-s-md pt-4 pb-4"></div>


                <!-- Profile Dropdown -->
                <v-col cols="auto" class="ml-n3  mr-10  pt-0 pb-0 pr-10">
                    <div class="d-flex align-center ga-2 rounded pa-0 ps-12">
                        <ProfileDropdown>
                            <p class="text-subtitle-1 text-left">User</p>
                        </ProfileDropdown>
                    </div>

                </v-col>
            </v-row>
        </v-app-bar>

        <!-- Main Content -->
        <v-main class="bg-background ">
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
import Sidebar from "./Sidebar.vue";
import ProfileDropdown from "./ProfileDropdown.vue";
import Notificationdropdown from "./Notificationdropdown.vue";

import { mdiFullscreen } from "@mdi/js";
import { getMenu } from "@services/menuService";
import { useThemeStore } from "@stores/themeStore";
import ThemeDropdown from "./ThemeDropdown.vue";

export default {
    name: "App",
    components: {
        Sidebar,
        ProfileDropdown,
        Notificationdropdown,
        ThemeDropdown,
    },
    computed: {},
    data() {
        return {
            drawer: true,
            menus: getMenu(),
            themeStore: useThemeStore(),
            path: mdiFullscreen,
            hoverFullscreen: false,
            hoverTheme: false,
            hoverNotification: false,
            hoverProfile: false,
            logoMenu: false,
            isHovered: false,
            isMenuOpen: false,
        };
    },
    methods: {
        toggleFullScreen() {
            if (!this.isFullScreen) {
                const element = document.documentElement;
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }

            this.isFullScreen = !this.isFullScreen;
            this.path = this.isFullScreen ? mdiFullscreenExit : mdiFullscreen;

        },
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
            this.themeStore.toggleMenuType();
        },
    },
};
</script>
<style>
.v-overlay__content {
    top: 75px !important;
}
</style>
