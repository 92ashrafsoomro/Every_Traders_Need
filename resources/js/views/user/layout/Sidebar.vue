<template>
    <v-navigation-drawer class="pa-0" app dark color="" :width="menuWidth" v-model="themeStore.menuOpen">
        <v-list density="compact" class="" nav>
            <v-list-item class="d-flex " style="height: 57px; ">

                <img v-if="menuWidth == 258"
                    :src="currentLogo" 
                    style="width: auto; height: 40px; margin-left: -1px;" />
                
                <img v-else :src="smallCurrent"
                     style="width: 40px; height: 40px;" /> 
            
            </v-list-item>



            <v-divider class="ps-0 pe-0"></v-divider>

            <!-- Dynamic Menu Items -->
            <template v-for="(item, index) in userMenu" :key="index">

                <!-- NORMAL ITEM -->
                <v-list-item v-if="item.type !== 'group'" :to="item.path" link :ripple="false"
                    class="menu-item text-subtitle-1" active-class="bg-primary on-primary rounded-sm my-active-menu">

                    <!-- CUSTOM ICON -->
                    <template #prepend>
                        <div class="menu-icon-wrapper">
                            <v-icon size="25" class="ml-1">
                                {{ item.icon }}
                            </v-icon>
                        </div>
                    </template>

                    <!-- TITLE -->
                    <template #title>
                        <span class="text-body-1 ml-6   ">
                            {{ item.label }}
                        </span>
                    </template>


                </v-list-item>

                <!-- GROUP / DIVIDER -->
                <v-list-item v-else class="mt-8  " :subtitle="item.label">
                    <v-divider class="mt-2 " />
                </v-list-item>

            </template>

            <div v-if="userStore.user.role !== 'Subscriber'" class="d-flex ga-6 ml-3 mt-2"> <v-icon class="mt-2 text-text_light_on">mdi-shield-crown</v-icon>
                <v-list-item active-class="bg-primary on-primary  rounded my-active-menu hide-overlay text-body-1">
                    <router-link to="/admin" style="text-decoration: none ;" class="text-whiteLight">
                        Admin</router-link></v-list-item>
            </div>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import { useDisplay, useTheme } from "vuetify";
import { useThemeStore } from "@stores/themeStore";
import userMenu from "./userMenu.json";
import logo from "@assets/images/logo/logo.png"
import newLogo from "@assets/images/logo/newLogo.png"
import darkLogo from "@/assets/images/header/darkfull.png"
import lightLogo from "@/assets/images/header/lightfull.png"
import darkshortLogo from "@/assets/images/header/darkshort.png"
import lightshortLogo from "@/assets/images/header/lightshort.png"
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
            vuetify: useTheme(),
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
/* Alternative (more future-proof) – target the actual overlay class */
.my-active-menu .v-list-item__overlay {
    display: none !important;
}
</style>
