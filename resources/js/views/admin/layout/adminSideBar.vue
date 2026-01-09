<template>
    <v-navigation-drawer class="pa-0" app dark color="" :width="menuWidth" v-model="themeStore.menuOpen">
        <v-list density="compact" class="" nav>

            <v-list-item class="d-flex " style="height: 57px; ">
                <img v-if="menuWidth == 300" :src="currentLogo" style="width: auto; height: 40px; margin-left: -1px;" />
                <img v-else :src="smallCurrent" style="width: 40px; height: 40px;" />
            </v-list-item>

            <v-divider class="ps-0 pe-0"></v-divider>

            <!-- Dynamic Menu Items -->
            <template v-for="(item, index) in userMenu" :key="index">

                <v-list-item v-if="item.type == 'group'" class="pl-n1 mt-8" title="" :subtitle="item.label">
                    <v-divider class="mt-2"></v-divider>
                </v-list-item>

                <!-- Show only top-level items, ignore children -->
                <v-list-item v-else :to="item.path" link :ripple="false" class="text-body-1"
                    active-class="bg-primary on-primary rounded my-active-menu">
                    <template #prepend>
                        <v-icon size="24" class="ml-1">{{ item.icon }}</v-icon>
                    </template>
                    <template #title>
                        <span :ripple="false" class="text-body-1">{{ item.label }}</span>
                    </template>
                </v-list-item>

            </template>


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
            openGroup: null,
            newLogo,
            userStore: useUserStore(),
            vuetify: useTheme()
        };
    },
    computed: {
        menuWidth() {
            if (this.display.mdAndDown) {
                return 300
            } else {
                return this.themeStore.menuType == "expanded" ? 300 : 68
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
        },
        isCollapsed() {
            return this.menuWidth == 68
        }
    },
    methods: {
        handleGroupClick(label) {
            if (this.isCollapsed) {
                this.themeStore.menuType = "expanded"

                this.$nextTick(() => {
                    this.openGroup = label
                })
            } else {
                this.openGroup = this.openGroup === label ? null : label
            }
        },
        images() {
            return this.isDark ? darkLogo : lightLogo;
        },
        toggleTheme() {
            this.vuetify.change(this.isDark ? "adminLight" : "adminDark")
        }
    },
    mounted() {

    },
    watch: {
        menuWidth(newVal) {
            if (newVal === 68) {
                this.openGroup = null
            }
        }
    }


};
</script>
<style>
.my-active-menu .v-list-item__overlay {
    display: none !important;
}
</style>