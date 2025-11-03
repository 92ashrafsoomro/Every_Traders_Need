<template>
  <v-app>
        <v-navigation-drawer app v-model="drawer" color="primary" dark>
            <v-list>
                <v-list-item>
                <v-list-item-title class="text-h6">My Dashboard</v-list-item-title>
                </v-list-item>

                <v-divider></v-divider>

                <v-list-item link>
                <v-list-item-icon><v-icon>mdi-view-dashboard</v-icon></v-list-item-icon>
                <v-list-item-title>Dashboard</v-list-item-title>
                </v-list-item>

                <v-list-item link>
                <v-list-item-icon><v-icon>mdi-account</v-icon></v-list-item-icon>
                <v-list-item-title>Users</v-list-item-title>
                </v-list-item>

                <v-list-item link>
                <v-list-item-icon><v-icon>mdi-cog</v-icon></v-list-item-icon>
                <v-list-item-title>Settings</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="primary" dark>
           <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
           <v-toolbar-title>Simple Dashboard</v-toolbar-title>
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
  name: 'App',
    components: {
        // Dashboard 
  },
  data() {
    return {
      drawer: true,
    }
  },
}
</script>
