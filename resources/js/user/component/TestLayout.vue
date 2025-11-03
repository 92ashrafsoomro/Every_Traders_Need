<template>
    <v-app>
        <Sidebar />

        <v-app-bar app color="secondary" class="topBar" dark>
            <v-app-bar-nav-icon
                @click="themeStore.toggleMenu()"
                class="d-xl-none"
            ></v-app-bar-nav-icon>
            <v-toolbar-title>Dashboard</v-toolbar-title>

            <div class="rightIcons">
                <div class="icon_wrapper">
                    <NotificationDropdown />
                </div>
                <div class="icon_wrapper">
                    <ProfileDropdown />
                </div>
            </div>
        </v-app-bar>

        <v-main>
            <v-container class="mt-6">
                <!-- <Dashboard /> -->
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import { getMenu } from "../../core/services/menuService";
import { useThemeStore } from "../../stores/theme";
import Sidebar from "./Sidebar.vue";
import ProfileDropdown from "./ProfileDropdown.vue";

export default {
    name: "App",
    components: {
        Sidebar,
        ProfileDropdown,
    },
    computed: {},
    data() {
        return {
            drawer: true,
            menus: getMenu(),
            themeStore: useThemeStore(),
        };
    },
    methods: {},
};
</script>
<style>
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
