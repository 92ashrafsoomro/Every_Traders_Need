<template>
    <v-container class="bg-background pa-0" style="max-width: 100%; height: 80px; position: fixed; z-index: 1; ">
        <v-container class="d-flex bg-background pa-0 align-center" style="height: 80px; max-width: 85%;">


            <!-- Logo -->
            <v-list-item class="d-flex ">
                <img :src="logo" class="d-flex justify-center align-center " height="30px" />
            </v-list-item> <v-spacer />
            <!-- Hamburger (small screens) -->

            <v-app-bar-nav-icon class="d-lg-none" @click="drawer = !drawer" />



            <!-- All nav items + buttons in single flex div -->
            <div class="d-none d-lg-flex flex-grow-1 justify-end  bg-background ">



                <v-list-item v-for="(item, index) in navMenu" :key="index" :to="item.path" link>
                    <v-btn v-if="item.label == 'Get Started'" variant="outlined"
                        class="border-thin text-capitalize bg-shadow hover:bg-primary">{{ item.label }}</v-btn>
                    <router-link v-else :to="item.path" 
                        class="text-capitalize text-body-2 bg-background text-decoration-none">
                        {{ item.label }}
                    </router-link>
                </v-list-item>
            </div>

            <!-- Drawer (small screens) -->
            <v-navigation-drawer v-model="drawer" temporary class="d-lg-none mt-14">
                <v-list>
                    <v-list-item v-for="(item, index) in navMenu" :key="index" :to="item.path" link>
                        <v-list-item-title>{{ item.label }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>
        </v-container>

    </v-container>
    <div class="bg-shadow  mx-auto" style="height: 0.5px; width: 100% ;"></div>
</template>

<script>

import logo from '@/assets/images/logo/logo.png'
import navbarItem from "@/enums/WebHeaderMenu"

export default {

    data() {
        return {
            drawer: false,
            navMenu: navbarItem,
            logo: logo
        }

    }


}


</script>
