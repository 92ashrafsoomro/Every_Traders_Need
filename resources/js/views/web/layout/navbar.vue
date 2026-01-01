<template>
    <!-- Top Navbar -->
    <v-sheet class="w-100 position-fixed top-0 bg-tra left-0  transition"
        :class="isScrolled ? 'glass' : 'bg-transparent'" style="z-index: 100;" height="50">
        <v-container class="pa-0 h-100" style="max-width:1400px">
            <div class="d-flex align-center justify-space-between pa-4 h-100">

                <!-- Logo -->
                <router-link to="/" class="d-flex align-center">
                    <img :src="currentLogo" height="32" />
                </router-link>

                <!-- Desktop Navigation Menu -->
                <div class="d-none d-lg-flex pt-3 align-center ga-8">
                    <v-btn v-for="(item, i) in navMenu" :key="i" :to="item.path" variant="text" rounded="sm"
                        class="navItem pb-0 text-capitalize text-body-1 text-light_text_on pb-2 "
                        :class="{ activeNav: $route.path === item.path }">
                        {{ item.label }}
                    </v-btn>

                </div>

                <div class="d-flex align-center ga-3">


                    <v-btn @click="toggleTheme" :icon="isDark ? 'mdi-lightbulb-off' : 'mdi-lightbulb-on'" size="40"
                        class="rounded-lg border" elevation="0" variant="text" />


                    <div class="d-flex align-center ga-2">


                        <ProfileDropdown v-if="userStore.is_logged_in" />


                        <v-btn v-else to="/login" variant="text" class="text-capitalize border">
                            Log In
                        </v-btn>


                        <v-btn v-if="!userStore.is_logged_in" to="/register" color="primary" variant="flat"
                            class="border-thin text-capitalize">
                            Register
                        </v-btn>

                    </div>

                    <!-- Hamburger Menu for Mobile -->
                    <v-app-bar-nav-icon class="d-lg-none" @click="drawer = !drawer" />

                </div>
            </div>
        </v-container>
    </v-sheet>

    <!-- Mobile Navigation Drawer -->
    <v-navigation-drawer v-model="drawer" temporary location="left" width="280" class="mt-13"
        :class="isScrolled ? 'glass' : 'bg-surface'">
        <div class="d-flex flex-column h-100">

            <!-- Nav Menu -->
            <v-list nav class="mt-6">
                <v-list-item v-for="(item, i) in navMenu" :key="i" :to="item.path" class="text-white">
                    <v-list-item-title class="text-h6">{{ item.label }}</v-list-item-title>
                </v-list-item>
            </v-list>

            <div class="flex-grow-1"></div>

            <!-- Login/Register for mobile -->
            <div class="pa-6 d-flex flex-column ga-4" style="margin-bottom: 50px;">
                <template v-if="!userStore.is_logged_in">
                    <v-btn to="/login" variant="outlined" color="white" block height="50"
                        class="text-capitalize text-white">
                        Login
                    </v-btn>
                    <v-btn to="/register" color="primary" block height="50" class="text-capitalize text-white">
                        Sign Up
                    </v-btn>
                </template>
            </div>

        </div>
    </v-navigation-drawer>
</template>

<script>
import navbarItem from "@/enums/WebHeaderMenu";
import darkLogo from "@/assets/images/header/darkfull.png";
import lightLogo from "@/assets/images/header/lightfull.png";
import { useTheme } from "vuetify";
import { useUserStore } from "@/stores/userStore";
import ProfileDropdown from "@/views/user/layout/ProfileDropdown.vue";

export default {
    name: "navbar",
    components: {
        ProfileDropdown,
    },
    data() {
        return {
            drawer: false,
            navMenu: navbarItem,
            theme: useTheme(),
            userStore: useUserStore(),
            isScrolled: false,
        };
    },
    computed: {
        isDark() {
            return this.theme.global.name === "adminDark";
        },
        currentLogo() {
            return this.isDark ? darkLogo : lightLogo;
        },
    },
    methods: {
        toggleTheme() {
            this.theme.change(this.isDark ? "adminLight" : "adminDark");
        },
        onScroll() {
            this.isScrolled = window.scrollY > 20;
        },
    },
    mounted() {
        window.addEventListener("scroll", this.onScroll);
    },
    beforeUnmount() {
        window.removeEventListener("scroll", this.onScroll);
    },
};
</script>

<style scoped>
.glass {
    background: rgba(var(--v-theme-surface), 0.5) !important;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid rgb(var(--v-theme-border));
}

.transition {
    transition: all 0.3s ease;
}

.navItem {
    border-bottom: 2px solid transparent;
    transition: border-bottom 0.3s;
}

.navItem:hover {
    border-bottom: 2px solid rgb(var(--v-theme-primary));

}

.activeNav {
    color: white;
    padding: 0;
    border-bottom: 3px solid rgb(var(--v-theme-primary));
}
</style>
