<template>
    <main>
        <TitleBar
            title="Dashboard Overview"
            subtitle="Monitor your stats and activities here"
        ></TitleBar>
    </main>
</template>


<script>

import { useThemeStore } from "../../stores/theme";
import { useUserStore } from "../../stores/userStore";
import TitleBar from "./../component/TitleBar.vue";


export default {
    props: {},
    components: {
      TitleBar,
    },
    data() {
        return {
            themeStore: useThemeStore(),
            userStore:useUserStore(),
        };
    },
    methods: {
      
    },
    mounted() {     
        
        // this.userStore.$subscribe((mutation, state) => {
        //     console.log('New state:', state.user)
        // });
        // this.userStore.syncUser();

       

      
        
     
    },
};

</script>

<style scoped>

</style>
