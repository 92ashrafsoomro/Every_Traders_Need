<template>
    <v-app>
        <Sidebar />

        <!-- Top App Bar -->
        <v-app-bar app color="" class="d-flex align-center justify-space-between elevation-3" dark>
            <v-app-bar-nav-icon class="d-lg-none" @click="themeStore.toggleMenu()"></v-app-bar-nav-icon>

            <v-toolbar-title class="d-none d-sm-inline">
                <v-text class="text-h6">Dashboard</v-text>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <!-- Icon Group -->
            <v-row class="pr-2 ga-5" align="center" justify="end" no-gutters>
                <!-- Fullscreen -->
                <v-col cols="auto">
                    <v-sheet color="" class="rounded-lg d-flex align-center justify-center rounded-lg pa-2 bg-shadow">
                        <svg-icon @click="toggleFullScreen" type="mdi" :path="path" class="cursor-pointer" />
                    </v-sheet>
                </v-col>

                <!-- Theme Dropdown -->
                <v-col cols="auto">
                    <v-sheet color="" class="rounded-lg d-flex align-center justify-center rounded-lg bg-shadow">
                        <ThemeDropdown />
                    </v-sheet>
                </v-col>

                <!-- Notification Dropdown -->
                <v-col cols="auto">
                    <v-sheet color="" class="rounded-lg d-flex align-center justify-center rounded-lg bg-shadow">
                        <Notificationdropdown />
                    </v-sheet>
                </v-col>

                <!-- Profile Dropdown -->
                <v-col cols="auto">
                    <v-sheet color="" class="rounded-lg d-flex align-center justify-center rounded-lg bg-shadow">
                        <ProfileDropdown />
                    </v-sheet>
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
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiFullscreen } from "@mdi/js";
import { getMenu } from "../../../core/services/menuService";
import { useThemeStore } from "../../../stores/theme";
import ThemeDropdown from "./ThemeDropdown.vue";

export default {
    name: "App",
    components: {
        Sidebar,
        ProfileDropdown,
        Notificationdropdown,
        ThemeDropdown,
        SvgIcon,
    },
    computed: {},
    data() {
        return {
            drawer: true,
            menus: getMenu(),
            themeStore: useThemeStore(),
            path: mdiFullscreen,
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
    },
};
</script>
<style></style>
