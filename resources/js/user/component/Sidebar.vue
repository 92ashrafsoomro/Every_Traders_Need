<template>
    <v-navigation-drawer app dark color="secondary" :width="menuWidth" v-model="themeStore.menuOpen">
        <v-list>
            <v-list-item>
                <img src="/public/theme/assets/logo_autoboli.png" class="logoImg" />
                <button class="logoType d-none d-lg-block" @click="themeStore.toggleMenuType()">
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
                <div class="listItem" v-if="item.type !== 'group'">
                    <v-list-item-icon><span class="material-symbols-outlined">{{item.icon}}</span></v-list-item-icon>
                    <v-list-item-title class="text-subtitle-1">{{ item.label }}</v-list-item-title>
                </div>
                <div v-else class="groupItem">
                    <v-list-item-title class="groupLabel text-subtitle-2">{{item.label}}</v-list-item-title>
                    <hr class="groupDivider" />
                </div>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>     
</template>

<script>
import { useDisplay } from 'vuetify'
import { useThemeStore } from "../../stores/theme";
import { getMenu } from "../../core/services/menuService";

export default {
    data() {
        return {
            menus: getMenu(),
            themeStore: useThemeStore(),
            display: useDisplay(),
        };
    },
    computed: {
        menuWidth() {
          
            
            if (this.display.lgAndDown) {
                  console.log('Mobile');
                return this.themeStore.menuType == "expanded" ? "258" : "74";
                  
            } else {
                  console.log('desktop');
                 return this.themeStore.menuType == "expanded" ? "258" : "74";
            }
        },
    },
    methods: {
      
    },
    mounted() {

       
    },
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