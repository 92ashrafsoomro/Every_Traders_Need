<template>
    <v-app class="bg-white">
  
                <Navbar/>

         <v-main   style=" min-height: 100vh;  ">
            <router-view></router-view>
        </v-main>
        <Footer/>
     

    </v-app>
</template>


<script>
import Footer from './footer.vue';
import Navbar from './navbar.vue';

export default {
    name : "App",
    components:{
        Navbar,
        Footer
    }
}
</script>