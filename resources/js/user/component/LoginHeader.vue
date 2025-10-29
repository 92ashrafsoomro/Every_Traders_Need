<template>
    <div :class="'my-header thememode-'+themeStore.themeMode">
        <!-- Minimal header for auth pages -->
        <header class="absolute inset-x-0 top-0 z-20">
            <div class="mx-auto  px-4 py-4 d-flex items-center justify-content-between">
                <!-- Logo -->
                <a href="https://localhost/autoboli" class="flex items-center gap-2">
                    <img src="https://localhost/autoboli/public/theme/assets/web/images/nave-icon.png" alt="AutoBoli" class="h-8 w-auto block">
                </a>
                <div class="flex align-items-center gap-3">
                    <button @click="themeStore.toggleThemeMode()" class="theme-mode-button"
                        aria-label="Toggle theme">
                        <i  v-if="themeStore.themeMode == 'dark'" class="fas fa-sun text-yellow-400"></i>
                        <i v-else class="fas fa-moon text-gray-900"></i>
                    </button>
                    <a href="https://localhost/autoboli"
                        class="btn btn-primary">
                        Back to Home
                    </a>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
  import { useThemeStore } from '../stores/theme'


   export default {
    name: 'Login',
        data() {
            return {
                themeStore: useThemeStore(),
            }
        },
        computed: {
        
        },
        methods: {
        
        },
    }

</script>

<style scoped>

.thememode-dark{
    background-color: #000F21;
}


.thememode-light{
    background-color: #f3f4f6;
}



.thememode-dark .theme-mode-button{
    background-color:#000F21;
    color: white;
    border: none;
}

.thememode-light .theme-mode-button{
    background-color:#f3f4f6;
    border: black;
    border: none;
}



.theme-mode-button{
    padding: 5px 10px;
    margin-right: 5px;
}



    
</style>
