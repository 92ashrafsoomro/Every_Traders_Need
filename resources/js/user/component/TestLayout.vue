<template>
    <v-app>
       
        <Sidebar />

        <v-app-bar app color="secondary" class="topBar" dark>
            <v-app-bar-nav-icon
                @click="themeStore.toggleMenuType()"
                class=""
            ></v-app-bar-nav-icon>
            <v-toolbar-title>Simple Dashboard</v-toolbar-title>

            <!-- Notification Menu -->
            <v-menu location="bottom" transition="fade-transition">
                <template #activator="{ props }">
                    <v-btn icon v-bind="props" color="white">
                        <v-icon>mdi-bell</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item>
                        <v-list-item-title>My Profile</v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>Settings</v-list-item-title>
                    </v-list-item>
                    <v-divider></v-divider>
                    <v-list-item>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>

            <v-menu location="bottom" transition="fade-transition">
                <template #activator="{ props }">
                    <v-btn icon v-bind="props">
                        <v-avatar size="32">
                            <img
                                src="https://randomuser.me/api/portraits/men/32.jpg"
                                alt="User"
                            />
                        </v-avatar>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item>
                        <v-list-item-title>My Profile</v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>Settings</v-list-item-title>
                    </v-list-item>
                    <v-divider></v-divider>
                    <v-list-item>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <v-main>
            <v-container class="mt-6">
                <!-- <Dashboard /> -->
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import { getMenu } from '../../core/services/menuService';
import { useThemeStore } from '../../stores/theme';
import Sidebar from "./Sidebar.vue"


export default {
    name: "App",
    components: {
         Sidebar
    },
    computed: {
        menucheck() {
           return this.themeStore.menuType == 'expanded' ? true : false
        }
    },
    data() {
        return {
            drawer: true,
            menus: getMenu(),
            themeStore: useThemeStore(),
        };
    },
    methods: {},
};
</script>
<style>
.listItem {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    column-gap: 20px;
}
.topBar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logoDiv {
    position: relative;
}

.logoType {
    height: 20px;
    width: 20px;
    background-color: #0080ff;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    right: 0;
    top: 20px;
}

.logoImg {
    display: flex;
    justify-content: center;
    align-items: center;
    object-fit: cover;
}
</style>
