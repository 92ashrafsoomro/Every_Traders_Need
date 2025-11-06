<template>
    <div>
         <router-view></router-view>
         <v-overlay :model-value="vuetify.current.loading" :persistent="true" class="align-center justify-center">
          <v-progress-circular color="primary" size="64" indeterminate></v-progress-circular>
        </v-overlay>
        <Alert />
    </div>
</template>

<script>
import { syncUser } from './core/services/userService';
import { useThemeStore } from './stores/theme';
import { useUserStore } from './stores/userStore';
import Alert from '@components/alert.vue'
import Overlay from '@components/overlay.vue'
import { toRaw } from 'vue'
import { useTheme } from 'vuetify';

export default {
  props: {},
  components: {
    Alert,
    Overlay
  },
  data() {
    return {
      themeStore: useThemeStore(),
      userStore: useUserStore(),
      vuetify: useTheme(),
    };
  },
  methods: {


  },
  async mounted() {

    
    const router = this.$router

     router.beforeEach((to, from, next) => {
            this.vuetify.themes['adminDark'].loading = true;
          next()
      })

        // 🟢 Hide loader after navigation completes
      router.afterEach(() => {
          setTimeout(() => {
            this.vuetify.themes['adminDark'].loading = false;
          }, 200)
      })



    this.userStore.$subscribe((mutation, state) => {
      // console.log("Mutation:", mutation);
      console.log("New state:", toRaw(state));
    });


  },
};

</script>