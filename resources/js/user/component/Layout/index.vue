<template>
    <v-app>
        <Sidebar />

        <v-app-bar
            app
            color="secondary"
            class="d-flex align-center justify-space-between"
            dark
        >
            <v-app-bar-nav-icon
                @click="themeStore.toggleMenu()"
                class="d-lg-none"
            ></v-app-bar-nav-icon>
            <v-toolbar-title>
                <p class="d-none d-sm-inline">Dashboard</p>
            </v-toolbar-title>

            <div class="pr-2 ga-5 d-flex align-center justify-center">
                <div
                    class="icon_wrapper d-flex align-center justify-center rounded-lg"
                >
                    <svg-icon
                        @click="toggleFullScreen"
                        type="mdi"
                        :path="path"
                        class="cursor-pointer"
                    ></svg-icon>
                </div>
                <div
                    class="icon_wrapper d-flex align-center justify-center rounded-lg"
                >
                    <ThemeDropdown />
                </div>
                <div
                    class="icon_wrapper d-flex align-center justify-center rounded-lg"
                >
                    <Notificationdropdown />
                </div>
                <div
                    class="icon_wrapper d-flex align-center justify-center rounded-lg"
                >
                    <ProfileDropdown />
                </div>
            </div>
        </v-app-bar>

        <v-main class="routerMain">
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
<style>
.routerMain {
    background-color: #0f1c2b;
}

.icon_wrapper {
    background-color: #353f4c;
    height: 30px;
    width: 30px;
}

.logoDiv {
    position: relative;
}

.logoType {
    height: 20px;
    width: 20px;
    background-color: #0080ff;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    right: 0;
    top: 20px;
}

.logoImg {
    display: flex;
    justify-content: center;
    align-items: center;
    object-fit: cover;
}
</style>
