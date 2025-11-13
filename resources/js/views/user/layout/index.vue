<template>
    <v-app>
        <Sidebar />

        <!-- Top App Bar -->
        <v-app-bar app color="" class="d-flex align-center justify-space-between elevation-3 border-b"
            style="height: 70px;">
            <v-app-bar-nav-icon class="d-lg-none" @click="themeStore.toggleMenu()"></v-app-bar-nav-icon>
            <div class="logoType  d-none d-lg-flex align-center justify-center rounded-circle border"
                style="width: 30px; height: 30px;">
                <v-icon class="d-lg-inline-flex justify-center align-center position-absolute d-none " size="default"
                    icon="mdi-menu-right" @click="themeStore.toggleMenuType()"></v-icon>
            </div>

            <v-toolbar-title class="d-none d-sm-inline pl-1">
                <p class="text-h6">Dashboard</p>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <!-- Icon Group -->
            <v-row class="pr-2 ga-5" align="center" justify="end" no-gutters>
                <!-- Fullscreen -->
                <v-col cols="auto">
                    <v-sheet color="" class="rounded-lg d-flex align-center justify-center rounded-lg pa-2 bg-shadow">
                        <v-icon icon="mdi-fullscreen" class="cursor-pointer" @click="toggleFullScreen"></v-icon>
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
<style>
.logoType {
    height: 20px;
    width: 20px;
    right: -10px;
    top: 20px;
}

.logoType:hover {
    background-color: #0080ff;
}
</style>
