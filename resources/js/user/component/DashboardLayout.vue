<template>
  <div class="layout">
    <header >
    </header>

    <div class="d-flex">
        
        <h1>Navbar</h1>
      <aside class="bg-light p-3" style="width: 200px;">
            <router-link to="/">🏠 Home</router-link><br />
            <router-link to="/about">ℹ️ About</router-link>
            <router-link to="/contact">ℹ️ Contact</router-link>
      </aside>

      <main class="flex-grow-1 p-4">

        <h1>Content</h1>
        <router-view />
        
       </main>
    </div>


    <footer>
        <h1>Footer</h1>
        
    </footer>
  </div>
</template>


<script setup>




</script>


<style scoped>

  header{
    padding: 0%;
    padding: 0%;
  }

   .headerMain{
    height: 80px;
    border-bottom: 1px solid #353f4c;
   }
</style>
