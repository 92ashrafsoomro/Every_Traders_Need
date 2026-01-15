<template>
    <v-navigation-drawer class="pa-0" app dark color="" :width="menuWidth" v-model="themeStore.menuOpen">
        <v-list density="compact" class="" nav>

            <v-list-item class="d-flex " style="height: 57px; ">
                <img v-if="menuWidth == 258" :src="currentLogo" style="width: auto; height: 40px; margin-left: -1px;" />
                <img v-else :src="smallCurrent" style="width: 40px; height: 40px;" />
            </v-list-item>

            <v-divider class="ps-0 pe-0"></v-divider>

            <!-- Dynamic Menu Items -->
            <v-expansion-panels  style="width: 250px; ">
                <v-expansion-panel v-for="group in userMenu" :key="group.label" class="pt-2 pr-2">
                  
                    <v-expansion-panel-title class="pa-2" style="background-color: rgb(var(--v-theme-primary),0.1);" >
                         <v-icon size="25" class="ml-3">{{ group.icon }}</v-icon> 
                    <span class="ml-8">{{ group.label }}</span>
                    </v-expansion-panel-title>
                    

                    <v-expansion-panel-text  >
                        <!-- Loop through children only inside this panel -->
                        <v-list-item v-for="item in group.children" :key="item.label" :to="item.path" link
                            class="text-body-1 pa-0 mt-2" active-class="bg-primary on-primary rounded my-active-menu">
                           <div class="d-flex align-center ml-3  "> <v-list-item-icon>
                                <v-icon size="25">{{ item.icon }}</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title class="text-body-1 ml-8">{{ item.label }}</v-list-item-title></div>
                        </v-list-item>
                    </v-expansion-panel-text>
                </v-expansion-panel>
            </v-expansion-panels>



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
        smallCurrent() {
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
