<template>
    
    <!-- NAV -->
    <v-app-bar>
<div style="max-width: 1400px;" class="mx-auto d-flex align-center">
        <div class="d-flex align-center  ">
            <v-list-item class="mt-2">
                <router-link to="/">
                    <img :src="logo" height="30px" />
                </router-link>
            </v-list-item>
        </div>

        <!-- Spacer -->
        <v-spacer />

        <!-- CENTER: NAV MENU (Desktop) -->
        <div class="d-none d-lg-flex align-center">
            <v-list-item v-for="(item, index) in navMenu" :key="index" :to="item.path" link
                class="m-item text-h6 mx-3 mb-2">
                <v-list-item-title class="nav-menu-links text-capitalize text-body-3">
                    {{ item.label }}
                </v-list-item-title>
            </v-list-item>
        </div>

        <!-- Spacer -->
        <v-spacer />

        <!-- RIGHT: Buttons -->
        <div class="d-flex align-center">
            <!-- Theme Toggle -->
            <v-list-item class="px-0">
                <v-icon class="hover-icon" @click="toggleTheme">
                    {{ isDark ? 'mdi-weather-night' : 'mdi-white-balance-sunny' }}
                </v-icon>
            </v-list-item>

            <!-- Login -->
            <v-list-item v-if="userStore.user" to="/login" class="px-0 d-none d-lg-flex">
                <v-btn variant="plain">SignIn</v-btn>
            </v-list-item>

            <!-- Dashboard -->
            <v-list-item v-if="userStore.user" to="/user/dashboard" class="px-0 d-none d-lg-flex">
                <v-btn color="surface" variant="flat" class="border-thin">
                    Get Started
                </v-btn>
            </v-list-item>

            <!-- Mobile Menu -->
            <v-app-bar-nav-icon class="d-lg-none" @click="drawer = !drawer" />
        </div>
</div>
    </v-app-bar>


    <!-- Mobile Drawer -->
    <v-navigation-drawer v-model="drawer" temporary class="d-lg-none mt-14">
        <v-list>
            <v-list-item v-for="(item, index) in navMenu" :key="index" :to="item.path" link>
                <v-list-item-title>{{ item.label }}</v-list-item-title>
            </v-list-item>

        </v-list>
        <div class="d-flex"><v-list-item v-if="userStore.user" to="/login" link class="pa-2 ma-0 d-lg-none d-flex">
                <v-btn variant="plain" class="text-capitalize">
                    SignIn
                </v-btn>
            </v-list-item>
            <v-list-item v-if="userStore.user" to="/user/dashboard" link class="pa-0 ma-0 d-lg-none d-flex">
                <v-btn variant="outlined" class="border-thin text-capitalize bg-background ">
                    Get Started
                </v-btn>
            </v-list-item>
        </div>
    </v-navigation-drawer>



    <div class="bg-shadow mx-auto" style="height: 0.5px; width: 100%"></div>
</template>

<script>
import logo from '@/assets/images/logo/logo.png'
import navbarItem from "@/enums/WebHeaderMenu"
import { useUserStore } from '@/stores/userStore';
import { useTheme } from "vuetify";

export default {
    data() {
        return {
            userStore: useUserStore(),
            drawer: false,
            navMenu: navbarItem,
            logo: logo,
            vuetify: useTheme(),
        }
    },
    computed: {
        isDark() {
            return this.vuetify.global.name === "adminDark"
        }
    },
    methods: {
        toggleTheme() {
            this.vuetify.change(this.isDark ? "adminLight" : "adminDark")
        }
    }
}
</script>

<style scoped>
.navbar {
    z-index: 10;
}

.my-btn {
    transition: all 0.3s ease;
    /* color: white; */
    /* background-color: #0080ff; */
}

.my-btn:hover {
    background-color: #0056b3;
    /* darker on hover */
    transform: scale(1.05);
    /* subtle grow effect */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    /* optional shadow */
}

.nav-menu-links {
    color: #B1BFCD;
}

.m-item:hover {
    background-color: transparent !important;
    color: white;
    border-bottom: 1px solid #0080ff;
}

.m-item {
    padding-top: 20px;
    padding-bottom: 12px;
}

.m-item:hover .nav-menu-links {
    color: white;
}

.v-list-item {
    --v-theme-overlay-multiplier: 0 !important;
}

.get-hover:hover {
    background-color: #0080ff;
}

.hover-icon:hover {
    color: #0080ff;
}
</style>