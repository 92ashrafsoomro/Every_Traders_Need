<template>
    <v-navigation-drawer
        :width="menuWidth"
        app
        v-model="menuCheck"
        color="secondary"
        dark
    >
        <v-list>
            <v-list-item>
                <img
                    src="/public/theme/assets/logo_autoboli.png"
                    class="logoImg"
                />
                <button
                    class="logoType d-xl-block"
                    @click="themeStore.toggleMenuType()"
                >
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </v-list-item>
            <v-divider></v-divider>

            <v-list-item
                v-for="(item, index) in menus"
                :key="index"
                :to="item.path"
                link
            >
                <div class="listItem">
                    <v-list-item-icon
                        ><span class="material-symbols-outlined">{{
                            item.icon
                        }}</span></v-list-item-icon
                    >
                    <v-list-item-title>{{ item.label }}</v-list-item-title>
                </div>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import { useThemeStore } from "../../stores/theme";
import { getMenu } from "../../core/services/menuService";

export default {
    data() {
        return {
            menus: getMenu(),
            themeStore: useThemeStore(),
        };
    },
    computed: {
        menuCheck() {
            return this.themeStore.menuType == "expanded" ? true : true;
        },
        menuWidth() {
            console.log("Changed");

            if (this.$vuetify.display.mdAndDown) {
                return this.themeStore.menuType == "expanded" ? "258" : "20";
            } else {
                return this.themeStore.menuType == "expanded" ? "65" : "258";
            }

            // return this.themeStore.menuType == "expanded" ? "65" : "258";
        },
    },
    mounted() {},
};
</script>

<style scoped>
.listItem {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    column-gap: 20px;
}
</style>
