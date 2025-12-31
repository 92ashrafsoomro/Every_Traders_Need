<template>
    <v-container class="navbar  bg-transparent pa-0 "
        style="max-width: 100%; height: 50px; position: fixed; z-index: 10;" :class="{ 'scrolled': isScrolled }">

        <v-container class="pa-0 d-flex align-center justify-space-between" style="height: 50px; max-width: 1500px;">

            <!-- NAV -->
            <nav class="d-flex align-center justify-space-between w-100 border-none">

                <!-- Logo -->
                <div class="d-flex align-center">
                    <v-list-item class="mt-2">
                        <router-link to="/"> <img :src="currentLogo" height="30px" /></router-link>
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
                            {{ isDark ? 'mdi-lightbulb-off' : 'mdi-lightbulb-on' }}
                        </v-icon>
                    </v-list-item>

                    <!-- Login -->
                    <v-list-item v-if="userStore.user" to="/login" link class="px-0   d-none d-lg-flex">
                        <v-btn variant="elevated" color="primary" class="text-capitalize "
                            v-if="userStore.is_logged_in == true">
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
            <v-navigation-drawer v-model="drawer" temporary class="d-lg-none border-t"
                style="margin-top: 50px; height: 100vh;">
                <!-- Navigation Menu -->
                <v-list>
                    <v-list-item v-for="(item, index) in navMenu" :key="index" :to="item.path" link>
                        <v-list-item-title>{{ item.label }}</v-list-item-title>
                    </v-list-item>
                </v-list>

                <!-- Buttons at the bottom -->
                <div class="d-flex flex-column px-3 pa-2   ga-3" style="margin-top: 430px; border-top: 1px solid rgb(var(--v-theme-border));">
                    <v-btn  v-if="userStore.is_logged_in" variant="outlined" color="primary"
                        class="text-capitalize w-100" to="/login">
                        My Account
                    </v-btn>

                    <v-btn v-else variant="outlined" class="text-capitalize w-100 mb-2" to="/login">
                        Login
                    </v-btn>

                    <v-btn v-if="!userStore.is_logged_in" color="primary" variant="flat" class="text-capitalize w-100"
                        to="/register">
                        Register
                    </v-btn>
                </div>
            </v-navigation-drawer>


        </v-container>

        <div v-if="isScrolled" class="bg-shadow mx-auto"></div>
    </v-container>
</template>

<script>
import logo from '@/assets/images/logo/logo.png'
import navbarItem from "@/enums/WebHeaderMenu"
import darkLogo from "@/assets/images/header/darkfull.png"
import lightLogo from "@/assets/images/header/lightfull.png"
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
        }, currentLogo() {
            if (this.isDark) {
                return darkLogo
            } else {
                return lightLogo
            }
        }
    },
    methods: {
        images() {
            return this.isDark ? [lightLogo] : [darkLogo]
        },
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
    },
    watch: {
        'theme.global.name'(newName) {
            this.vuetify.global.name = newName
        },
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

    color: rgb(var(--v-theme-light_text_on)) !important;

}

/* .nav-menu-links:hover {
    color: #B1BFCD;
     border-bottom: 1px solid #0080ff;
} */

.m-item:hover {
    background-color: transparent !important;
    color: white;
    border-bottom: 3px solid #0080ff;
}

::v-deep(.nav-menu-links-active).m-item {
    border-bottom: 3px solid #0080ff;
}

.m-item:hover .nav-menu-links {
    color: white;
}

::v-deep(.nav-menu-links-active) .nav-menu-links {

    color: rgb(var(--v-theme-whiteLite)) !important;


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