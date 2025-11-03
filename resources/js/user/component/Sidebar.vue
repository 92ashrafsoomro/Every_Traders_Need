<template>
            <v-list>
                <v-list-item>
                    <img src="http://localhost/autoboli/public/themeadmin/images/logo/logo.png" class="logoImg" />
                    <button class="logoType"></button>
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
import Image1  from '../../images/logo/logo.png'
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
