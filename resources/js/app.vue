<template>
  <div>
    <router-view></router-view>
    <v-overlay :model-value="themeStore.loading" class="align-center justify-center">
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
    };
  },
  methods: {


  },
  async mounted() {

    // this.themeStore.startLoading();
    // console.log('Theme Store ', this.themeStore.loading);

    await Promise.all([
      // this.userStore.syncUser(),
    ]);


    // this.themeStore.endLoading();
    // console.log('Theme Store ',this.themeStore.loading);

    this.userStore.$subscribe((mutation, state) => {
      // console.log("Mutation:", mutation);
      console.log("New state:", toRaw(state));
    });


  },
};

</script>