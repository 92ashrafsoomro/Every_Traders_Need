<template>
    <v-app>
        <Sidebar />

        <v-app-bar app color="secondary" class="topBar" dark>
            <v-app-bar-nav-icon
                @click="themeStore.toggleMenu()"
                class="d-xl-none"
            ></v-app-bar-nav-icon>
            <v-toolbar-title>
                <p class="d-none d-sm-inline">Dashboard</p>
            </v-toolbar-title>

            <div class="rightIcons">
                <div class="icon_wrapper">
                    <svg-icon
                        @click="toggleFullScreen"
                        type="mdi"
                        :path="path"
                        class="cursor-pointer"
                    ></svg-icon>
                </div>
                <div class="icon_wrapper">
                    <ThemeDropdown />
                </div>
                <div class="icon_wrapper">
                    <Notificationdropdown />
                </div>
                <div class="icon_wrapper">
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
import { getMenu } from "../../core/services/menuService";
import { useThemeStore } from "../../stores/theme";
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

.rightIcons {
    padding-right: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    column-gap: 20px;
}

.icon_wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 38px;
    width: 40px;
    background-color: #353f4c;
    border-radius: 8px;
    padding: 1px;
}

.listItem {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    column-gap: 20px;
}
.topBar {
    display: flex;
    justify-content: space-between;
    align-items: center;
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
