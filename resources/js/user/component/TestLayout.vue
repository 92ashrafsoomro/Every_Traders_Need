<template>
    <v-app>
        <v-navigation-drawer app v-model="drawer" color="secondary" dark>
            <v-list>
                <v-list-item>
                    <img
                        src="http://localhost/backup_autoboli/public/themeadmin/images/logo/logo.png"
                        alt=""
                        class="logoImg"
                    />

                    <button class="logoType"></button>
                </v-list-item>

                <v-divider></v-divider>

                <v-list-item link>
                    <div class="listItem">
                        <v-list-item-icon>
                            <v-icon
                                >mdi-view-dashboard</v-icon
                            ></v-list-item-icon
                        >
                        <v-list-item-title>Dashboard</v-list-item-title>
                    </div>
                </v-list-item>

                <v-list-item link>
                    <div class="listItem">
                        <v-list-item-icon
                            ><v-icon>mdi-account</v-icon></v-list-item-icon
                        >
                        <v-list-item-title>Users</v-list-item-title>
                    </div>
                </v-list-item>

                <v-list-item link>
                    <div class="listItem">
                        <v-list-item-icon
                            ><v-icon>mdi-cog</v-icon></v-list-item-icon
                        >
                        <v-list-item-title>Settings</v-list-item-title>
                    </div>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="secondary" class="topBar" dark>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
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
// import Dashboard from './components/Dashboard.vue'

export default {
    name: "App",
    components: {
        // Dashboard
    },
    data() {
        return {
            drawer: true,
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
    height: 74px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logoImg {
    display: flex;
    justify-content: center;
    align-items: center;
    object-fit: cover;
}
</style>
