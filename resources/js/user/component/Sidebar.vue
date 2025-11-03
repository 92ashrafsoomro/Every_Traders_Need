<template>
            <v-list>
                <v-list-item>
                    <img src="/public/theme/assets/logo_autoboli.png" class="logoImg" />
                    <button
                        class="logoType d-xl-block"
                        @click="drawer = !drawer"
                    >
                        <span class="material-symbols-outlined">
                            chevron_right
                        </span>
                    </button>
                </v-list-item>

                <v-divider></v-divider>

                <v-list-item v-for="(item, index) in menus" :key="index" :to="item.path" link>
                    <div class="listItem">
                        <v-list-item-icon> <span class="material-symbols-outlined">{{item.icon}}</span>
                            <!-- <v-icon>mdi-view-dashboard</v-icon> -->
                        </v-list-item-icon>
                        <v-list-item-title>{{ item.label }}</v-list-item-title>
                    </div>
                </v-list-item>
            </v-list>
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
    mounted() {
   
    },
};
</script>

<style scoped>
</style>
