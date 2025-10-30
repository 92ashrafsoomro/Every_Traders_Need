<template>


</template>

<script>

import { useThemeStore } from "../stores/theme";
import { useUserStore } from "../stores/user";


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
    mounted() {     

        
         
        this.userStore.$subscribe((mutation, state) => {

           
            console.log('New state:', state.user)


        });

        this.userStore.syncUser();

       

      
        
     
    },
};

</script>

<style scoped>

</style>
