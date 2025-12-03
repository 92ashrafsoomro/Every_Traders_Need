<template>
    <v-app >
        <Navbar/>
         <v-main class="bg-background "   >
          <div >
               <router-view></router-view>
       </div>
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