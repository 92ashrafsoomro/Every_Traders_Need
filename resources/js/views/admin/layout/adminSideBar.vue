<template>
    <v-navigation-drawer class="pa-0" app dark color="" :width="menuWidth" v-model="themeStore.menuOpen">
        <v-list density="compact" class="" nav>

            <v-list-item class="d-flex " style="height: 57px; ">
                <img v-if="menuWidth == 258" :src="currentLogo" style="width: auto; height: 40px; margin-left: -1px;" />
                <img v-else :src="smallCurrent" style="width: 40px; height: 40px;" />
            </v-list-item>

            <v-divider class="ps-0 pe-0"></v-divider>

            <!-- Dynamic Menu Items -->
            <template v-for="(item, index) in userMenu" :key="index">

                <v-list-item v-if="item.type == 'group'" class="pl-n1 mt-8" title="" :subtitle="item.label">
                    <v-divider class="mt-2"></v-divider>
                </v-list-item>

                <!-- Show only top-level items, ignore children -->
                <v-list-item v-else :to="item.path" link :ripple="false" class="text-body-1"
                    active-class="bg-primary on-primary rounded my-active-menu">
                    <template #prepend>
                        <v-icon size="24" class="ml-1">{{ item.icon }}</v-icon>
                    </template>
                    <template #title>
                        <span :ripple="false" class="text-body-1">{{ item.label }}</span>
                    </template>
                </v-list-item>

            </template>


        </v-list>
    </v-navigation-drawer>
</template>

<script>
import newLogo from "@assets/images/logo/newLogo.png"
import { useDisplay, useTheme } from "vuetify";
import { useThemeStore } from "@stores/themeStore";
import userMenu from "./adminMenu.json";
import darkLogo from "@/assets/images/header/darkfull.png"
import lightLogo from "@/assets/images/header/lightfull.png"
import darkshortLogo from "@/assets/images/header/darkshort.png"
import lightshortLogo from "@/assets/images/header/lightshort.png"
import logo from "@assets/images/logo/logo.png"
import { useUserStore } from "@/stores/userStore";
export default {
    data() {
        return {
            userMenu,
            themeStore: useThemeStore(),
            display: useDisplay(),
            logo: logo,
            newLogo,
            userStore: useUserStore(),
            vuetify: useTheme()
        };
    },
       computed: {
        menuWidth() {

            // md, sm, xs
            if (this.display.mdAndDown) {
                return "258";
            } else {
                //for: lg, xl
                return this.themeStore.menuType == "expanded" ? "258" : "70";
            }
        },
        isDark() {
            return this.vuetify.global.name === "adminDark"
        },
        currentLogo() {
            return this.isDark ? darkLogo : lightLogo
        },
        smallCurrent(){
             return this.isDark ? darkshortLogo : lightshortLogo
        }
    },
    methods: {
        images() {
            return this.isDark ? darkLogo : lightLogo;
        },
        toggleTheme() {
            this.vuetify.change(this.isDark ? "adminLight" : "adminDark")
        }

    },
    mounted() { },
    
};
</script>
<style>
.my-active-menu .v-list-item__overlay {
    display: none !important;
}
</style>