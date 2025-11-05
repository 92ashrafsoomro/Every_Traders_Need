<template>
    <v-navigation-drawer app dark color="secondary" :width="menuWidth" v-model="themeStore.menuOpen">
        <v-list density="compact" nav>
            <v-list-item class="d-flex">
                <img :src="logo" size class="logoImg" />
                <!-- @windsurf: check below div want to show this on bigger than 1278px screens -->
                <v-icon class="logoType d-none d-lg-inline-block" size="x-small" icon="mdi-greater-than"
                    @click="themeStore.toggleMenuType()"></v-icon>
            </v-list-item>

            <v-divider></v-divider>

            <!-- Dynamic Menu Items -->
            <template v-for="(item, index) in menus" :key="index">
                <!-- Regular Menu Items -->
                <v-list-item v-if="item.type !== 'group'" :to="item.path" link :prepend-icon="item.icon"
                    :title="item.label" class="text-subtitle-1" active-class="bg-primary text-white">
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
.listItem {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    column-gap: 20px;
}

.logoDiv {
    position: relative;
}

.logoType {

    background-color: #0080ff;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    right: -10px;
    top: 20px;
}

.logoImg {
    display: flex;
    justify-content: center;
    align-items: center;
    object-fit: cover;
}
</style>
