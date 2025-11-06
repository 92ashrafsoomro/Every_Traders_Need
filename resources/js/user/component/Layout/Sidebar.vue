<template>
    <v-navigation-drawer app dark color="" :width="menuWidth" v-model="themeStore.menuOpen">
        <v-list density="compact" nav>
            <v-list-item class="d-flex">
                <img :src="logo" size class="d-flex justify-center align-center object-cover" />
                <!-- @windsurf: check below div want to show this on bigger than 1278px screens -->
                <v-icon
                    class="logoType d-lg-inline-flex justify-center align-center position-absolute d-none bg-primary"
                    size="x-small" icon="mdi-greater-than" @click="themeStore.toggleMenuType()"></v-icon>
            </v-list-item>

            <v-divider></v-divider>

            <!-- Dynamic Menu Items -->
            <template v-for="(item, index) in menus" :key="index">
                <!-- Regular Menu Items -->
                <v-list-item v-if="item.type !== 'group'" :to="item.path" link :prepend-icon="item.icon"
                    class="text-subtitle-1" active-class="bg-primary-lighten-1 text-white">
                    <template #title>
                        <span class="text-body-1">{{ item.label }}</span>
                    </template>
                </v-list-item>

                <v-list-item v-else title="" :subtitle="item.label">
                    <v-divider class="mt-2"></v-divider>
                </v-list-item>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import { useDisplay } from "vuetify";
import { useThemeStore } from "../../../stores/theme";
import { getMenu } from "../../../core/services/menuService";
import logo from "@/images/logo/logo.png"

export default {
    data() {
        return {
            menus: getMenu(),
            themeStore: useThemeStore(),
            display: useDisplay(),
            logo: logo,
        };
    },
    computed: {
        menuWidth() {
            if (this.display.lgAndDown) {
                console.log("Mobile");
                return this.themeStore.menuType == "expanded" ? "258" : "68";
            } else {
                console.log("desktop");
                return this.themeStore.menuType == "expanded" ? "258" : "68";
            }
        },
    },
    methods: {},
    mounted() { },
};
</script>

<style scoped>
.logoType {
    height: 20px;
    width: 20px;
    right: -10px;
    top: 20px;
}
</style>
