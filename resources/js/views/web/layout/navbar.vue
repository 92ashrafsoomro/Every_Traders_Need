<template>
    <v-container class="navbar  bg-transparent pa-0 "
        style="max-width: 100%; height: 50px; position: fixed; z-index: 10;" :class="{ 'scrolled': isScrolled }">

        <v-container class="pa-0 d-flex align-center justify-space-between" style="height: 50px; max-width: 1500px;">

            <!-- NAV -->
            <nav class="d-flex align-center justify-space-between w-100 border-none">

                <!-- Logo -->
                <div class="d-flex align-center">
                    <v-list-item class="mt-2">
                        <router-link to="/"> <img :src="logo" height="30px" /></router-link>
                    </v-list-item>
                </div>

                <!-- NAV MENU (Desktop) -->
                <div class="d-none d-lg-flex align-center ga-7">
                    <v-list-item v-for="(item, index) in navMenu" :key="index" :to="item.path" link exact
                        class="m-item text-h6 mx-3 mb-2 pl-0 pr-0" active-class="nav-menu-links-active">
                        <v-list-item-title class="nav-menu-links  text-capitalize text-body-3 text-white_light_nav">
                            {{ item.label }}
                        </v-list-item-title>
                    </v-list-item>

                </div>

                <!-- RIGHT BUTTONS -->
                <div class="d-flex align-center">
                    <!-- Theme Toggle -->
                    <v-list-item class="px-0 text-end mr-2">
                        <v-icon class="hover-icon" @click="toggleTheme" link :color="'on-primary'">
                            {{ isDark ? 'mdi-weather-night' : 'mdi-white-balance-sunny' }}
                        </v-icon>
                    </v-list-item>

                    <!-- Login -->
                    <v-list-item v-if="userStore.user" to="/login" link class="px-0   d-none d-lg-flex">
                        <v-btn variant="elevated" color="primary" class="text-capitalize " v-if="userStore.is_logged_in == true">
                            My Account
                        </v-btn>
                        <v-btn variant="outlined" class="text-capitalize mr-2 " v-else>SignIn</v-btn>
                    </v-list-item>

                    <!-- Dashboard -->
                    <v-list-item v-if="!userStore.is_logged_in" to="/register" link class="px-0 d-none d-lg-flex">
                        <v-btn color="primary" variant="flat" class="border-thin text-capitalize ">
                            Register
                        </v-btn>
                    </v-list-item>

                    <!-- Hamburger icon for mobile -->
                    <v-app-bar-nav-icon class="d-lg-none" @click="drawer = !drawer" />
                </div>

            </nav>

            <!-- Mobile Drawer -->
            <v-navigation-drawer v-model="drawer" temporary class="d-lg-none mt-14">
                <v-list>
                    <v-list-item v-for="(item, index) in navMenu" :key="index" :to="item.path" link>
                        <v-list-item-title>{{ item.label }}</v-list-item-title>
                    </v-list-item>

                </v-list>
                <div class="d-flex"><v-list-item v-if="userStore.user" to="/login" link
                        class="pa-2 ma-0 d-lg-none d-flex">
                        <v-btn variant="plain" class="text-capitalize">
                            SignIn
                        </v-btn>
                    </v-list-item>
                    <v-list-item v-if="userStore.user" to="/register" link class="pa-0 ma-0 d-lg-none d-flex">
                        <v-btn variant="outlined" class="border-thin text-capitalize bg-background ">
                            Register
                        </v-btn>
                    </v-list-item>
                </div>
            </v-navigation-drawer>

        </v-container>

        <div v-if="isScrolled" class="bg-shadow mx-auto"></div>
    </v-container>
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
            isScrolled: false,
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
        },
        handleScroll() {
            this.isScrolled = window.scrollY > 20
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll)
    },
    beforeDestroy() { // Vue 2
        window.removeEventListener('scroll', this.handleScroll)
    },
    beforeUnmount() { // Vue 3
        window.removeEventListener('scroll', this.handleScroll)
    }
}

</script>

<style scoped>
.navbar {
    transition: all 0.3s ease;
}


.navbar.scrolled {
    box-shadow: 0 2px 6px rgba(108, 65, 65, 0.15);
    background-color: rgb(var(--v-theme-surface), 0.6) !important;

    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transition: all 0.3s ease;

}

.bg-shadow {
    height: 0.5px;
    width: 100%;
    background-color: #ccc;
}

.my-btn {
    transition: all 0.3s ease;
    /* color: white; */
    /* background-color: #0080ff; */
}

.my-btn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.nav-menu-links {
    color: #B1BFCD;
}

/* .nav-menu-links:hover {
    color: #B1BFCD;
     border-bottom: 1px solid #0080ff;
} */

.m-item:hover {
    background-color: transparent !important;
    color: white;
    border-bottom: 1px solid #0080ff;
}

::v-deep(.nav-menu-links-active).m-item {
    border-bottom: 3px solid #0080ff;
}

.m-item:hover .nav-menu-links {
    color: white;
}

::v-deep(.nav-menu-links-active) .nav-menu-links {
  
    color: rgb(var(--v-theme-light_text_on)) !important;

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