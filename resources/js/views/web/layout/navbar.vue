<template>
    <v-app-bar :elevation="2" class="d-flex  px-lg-15 px-5 justify-center align-center">


        <!-- Logo -->
        <v-img :src="logo" alt="Logo" max-height="40" max-width="120" class="cursor-pointer  mt-2"
            @click="$router.push('/')" /> <v-spacer />
        <!-- Hamburger (small screens) -->

        <v-app-bar-nav-icon class="d-lg-none" @click="drawer = !drawer" />



        <!-- All nav items + buttons in single flex div -->
        <div class="d-none d-lg-flex flex-grow-1 justify-end ">
            <!-- Nav Items -->
            <v-btn v-for="(item, index) in NavItems" :key="index" :to="item.path" text rounded>
                {{ item.label }}
            </v-btn>

            <!-- Nav Buttons -->
        </div>
        <div class="d-none d-lg-flex flex-grow-1 justify-center me-4">
            <v-btn v-for="(item, index) in Navbtns" :key="index" :to="item.path" variant="outlined">
                {{ item.label }}
            </v-btn>

        </div>
    </v-app-bar>

    <!-- Drawer (small screens) -->
    <v-navigation-drawer v-model="drawer" temporary class="d-lg-none">
        <v-list>
            <v-list-item v-for="(item, index) in NavItems" :key="index" :to="item.path" link>
                <v-list-item-title>{{ item.label }}</v-list-item-title>
            </v-list-item>

            <v-list-item v-for="(item, index) in Navbtns" :key="index" :to="item.path" link>
                <v-list-item-title>{{ item.label }}</v-list-item-title>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script >

import logo from '@/assets/images/logo/logo.png'


export default {

  data(){
    return {
        drawer : false,
        NavItems : [],
        Navbtns : [],
    }

  }


}


</script>
