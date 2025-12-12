<template>
    <v-navigation-drawer class="pa-0" app dark color="" :width="menuWidth" v-model="themeStore.menuOpen">
        <v-list density="compact" class="" nav>
            <v-list-item class="d-flex " style="height: 57px; ">
               
                <img v-if="menuWidth == 258" :src="logo" class="d-flex justify-center align-center" />

                <img v-else :src="newLogo" 
                    style="width: 30px; height: 30px;" class="ml-1"/>
            </v-list-item>



            <v-divider class="ps-0 pe-0"></v-divider>

            <!-- Dynamic Menu Items -->
            <template v-for="(item, index) in userMenu" :key="index">
                <!-- Regular Menu Items -->
                <v-list-item v-if="item.type !== 'group'" :to="item.path" link :prepend-icon="item.icon" :ripple="false"
                    :hide-overlay="false" class="text-subtitle-1"
                    active-class="bg-primary on-primary  rounded my-active-menu hide-overlay ">
                    <template #title>
                        <span :ripple="false" class="text-body-1">{{ item.label }}</span>
                    </template>
                </v-list-item>
                <v-list-item class="ml-n1 mt-8" v-else title="" :subtitle="item.label">
                    <v-divider class="mt-2"></v-divider>
                </v-list-item>

            </template>
            <div class="d-flex ga-6 ml-2"> <v-icon class="mt-2 text-text_light_on">mdi-shield-crown</v-icon>
                <v-list-item active-class="bg-primary on-primary  rounded my-active-menu hide-overlay text-body-1">
                    <router-link to="/admin" style="text-decoration: none ; color: white;">
                        Admin</router-link></v-list-item>
            </div>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import { useDisplay } from "vuetify";
import { useThemeStore } from "@stores/themeStore";
import userMenu from "./userMenu.json";
import logo from "@assets/images/logo/logo.png"
import newLogo from "@assets/images/logo/newLogo.png"
export default {
    data() {
        return {
            userMenu,
            themeStore: useThemeStore(),
            display: useDisplay(),
            logo: logo,
            newLogo
        };
    },
    computed: {
        menuWidth() {

            // md, sm, xs
            if (this.display.mdAndDown) {
                return "258";
            } else {
                //for: lg, xl
                return this.themeStore.menuType == "expanded" ? "258" : "58";
            }

        },
    },
    methods: {},
    mounted() { },
};
</script>
<style>
/* Alternative (more future-proof) – target the actual overlay class */
.my-active-menu .v-list-item__overlay {
    display: none !important;
}
</style>
