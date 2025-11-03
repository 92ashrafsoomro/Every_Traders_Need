<template>
      <div v-if="themeStore.loading">
        <p>Loading...</p>
      </div>
      <div v-else="themeStore.loading">
        <router-view></router-view>
      </div>
</template>

<script>
import { syncUser } from './core/services/userService';
import { useThemeStore } from './stores/theme';
import { useUserStore } from './stores/user';





export default {
    props: {},
    components: {
      
    },
    data() {
        return {
            themeStore: useThemeStore(),
            userStore:useUserStore(),
        };
    },
    methods: {
      
      
    },
    async mounted() {     

        this.themeStore.startLoading();
        // console.log('Theme Store ', this.themeStore.loading);

        await Promise.all([
          this.userStore.syncUser(),
        ]);

  
      this.themeStore.endLoading();
      // console.log('Theme Store ',this.themeStore.loading);

         this.userStore.$subscribe((mutation, state) => {
          // console.log("Mutation:", mutation);
          console.log("New state:", state);
        });

              
    },
};

</script>