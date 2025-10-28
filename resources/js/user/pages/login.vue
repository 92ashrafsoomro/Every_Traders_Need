<template>

    <div :class="'main'+' thememode-'+themeMode">

        <LoginHeader :themeMode="themeMode" :setThemeMode="setThemeMode" />
      
        <!-- Minimal header for auth pages -->
        <!-- <header class="absolute inset-x-0 top-0 z-20">
            <div class="mx-auto  px-4 py-4 d-flex items-center justify-content-between">
              
                <a href="https://localhost/autoboli" class="flex items-center gap-2">
                    <img src="https://localhost/autoboli/public/theme/assets/web/images/nave-icon.png" alt="AutoBoli" class="h-8 w-auto block">
                </a>
                <div class="flex align-items-center gap-3">
                    <button @click="setThemeMode()" class="theme-mode-button"
                        aria-label="Toggle theme">
                        <i  v-if="themeMode == 'dark'" class="fas fa-sun text-yellow-400"></i>
                        <i v-else class="fas fa-moon text-gray-900"></i>
                    </button>
                    <a href="https://localhost/autoboli"
                        class="btn btn-primary">
                        Back to Home
                    </a>
                </div>
            </div>
        </header> -->

    <!-- Login Page -->
    <div
        class="relative min-h-screen flex items-center justify-center bg-[#000f21] dark:bg-gray-100 overflow-hidden pt-20 transition-colors">


        <!-- decorative bottom background -->
        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-[42%] ">
            <div class="absolute right-0 bottom-0 w-[120%] h-full -skew-y-3 origin-bottom-right bg-[#0080ff]"></div>
            <div
                class="absolute right-0 bottom-0 w-[120%] h-full -skew-y-3 origin-bottom-right bg-[radial-gradient(#7b3fe6_1.2px,transparent_1.2px)] [background-size:16px_16px] opacity-30">
            </div>
        </div>

        <!-- Login Card -->
        <div class="container mx-auto px-4 py-12">
            <div class="mx-auto w-full max-w-lg">
                <div
                    class="rounded bg-[#0f1c2c] dark:bg-white shadow-2xl px-6 sm:px-16 py-10 relative z-10 animate-slideUp transition-colors">

                    <!-- Header -->
                    <h1 class="text-center text-3xl font-bold mb-3 text-white dark:text-gray-900">Welcome back!</h1>

                    <!-- Alerts -->
                                        
                    <!-- Continue with Google -->
                    <div class="mb-8">
                        <a href="https://localhost/autoboli/auth/google"
                            class="w-full inline-flex items-center justify-center gap-3 rounded-lg border border-slate-300 bg-transparent px-4 py-3 text-white dark:text-gray-800 hover:text-slate-800 font-medium hover:bg-slate-50 transition">
                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="h-5 w-5"
                                alt="G">
                            Continue with Google
                        </a>
                    </div>

                    <!-- Divider -->
                    <div class="relative my-4 mt-5">
                        <div class="h-px bg-gray-600 dark:bg-gray-300"></div>
                        <span
                            class="absolute inset-0 -top-3 m-auto w-fit px-2 text-xs font-semibold tracking-wide text-white dark:text-gray-700 bg-[#0f1c2c] dark:bg-white">
                            OR
                        </span>
                    </div>

                    <!-- Form -->
                    <form action="https://localhost/autoboli/login_submit" method="POST" class="space-y-4">
                        <input type="hidden" name="_token" value="GhhfUwoamDmNKtA4biAZ5nCjRT9cMJ3gvpifupMW" autocomplete="off">
                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="block text-xs font-semibold text-slate-200 dark:text-gray-700 mb-1">Work
                                Email</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-gray-500">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4-8 5L4 8V6l8 5 8-5v2Z" />
                                    </svg>
                                </span>
                                <input type="email" name="email" value=""
                                    class="w-full rounded-lg border border-slate-300 dark:border-gray-300 bg-transparent dark:bg-gray-100 pl-10 pr-3 py-3 text-white dark:text-gray-900"
                                    placeholder="Enter your work email">
                            </div>
                                                    </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label
                                class="block text-xs font-semibold text-slate-200 dark:text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-gray-500">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M17 8h-1V6a4 4 0 1 0-8 0v2H7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2ZM10 6a2 2 0 1 1 4 0v2h-4V6Zm2 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z" />
                                    </svg>
                                </span>
                                <input type="password" name="password" id="passwordField"
                                    class="w-full rounded-lg border border-slate-300 dark:border-gray-300 bg-transparent dark:bg-gray-100 pl-10 pr-12 py-3 text-white dark:text-gray-900"
                                    placeholder="Enter password">
                                <button type="button"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700"
                                    onclick="togglePassword()">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            
                            <div class="pt-3 mt-2 flex items-center justify-between text-sm">
                                <label class="inline-flex items-center gap-2 text-slate-600 dark:text-gray-700">
                                    <input type="checkbox" id="rememberMe"
                                        class="rounded border-slate-300 text-white dark:text-gray-900">
                                    <span class="text-white dark:text-gray-700">Remember me</span>
                                </label>
                                <a href="https://localhost/autoboli/forgot-password"
                                    class="text-[#0080ff] font-medium hover:underline">Forgot Password?</a>
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full rounded-lg bg-[#0080ff] hover:bg-[#0059B3] text-white font-semibold py-3 shadow-md transition">
                            Log In
                        </button>
                    </form>

                    <!-- SSO -->
                    <p class="mt-6 text-center text-white dark:text-gray-800 text-sm">
                        Don’t have an account?
                        <a href="https://localhost/autoboli/register"
                            class="font-semibold text-[#0080ff] hover:text-[#0059B3] hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    </div>
</template>

<script>

   import LoginHeader from '../component/LoginHeader.vue'
   
   export default {
        name: 'Login',
        components: {
          LoginHeader, 
        },
        data() {
            return {
                themeMode: 'dark', 
            }
        },
        computed: {
        
        },
        methods: {
            setThemeMode() {
                if (this.themeMode == 'dark') {
                    this.themeMode = 'light';
                } else {
                    this.themeMode = 'dark';
                }
            }
        },
    }

</script>

<style scoped>


    
</style>
