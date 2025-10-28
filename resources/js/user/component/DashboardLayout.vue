<template>
  <div class="layout">
    <header class="p-3 bg-dark text-white">
       <h1>Header..</h1>
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
    h1 {
        color: #42b983;
    }
</style>
