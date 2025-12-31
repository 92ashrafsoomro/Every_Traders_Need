<template>
      <div class=" w-100 h-100 bg-surface   pb-8" style="position: absolute;">
        <div class="pattern-bg"></div>
        <div class="position-relative  pt-5  " style=" max-width: 1400px; z-index: 10">
            
            <slot> </slot>
        </div>
    </div>
    <v-app class="bg-surface">
        
        <div class="position-absolute bottom-0 left-0 right-0 h-50 bg-primary"
            style="z-index: 0; border-radius:  0 300px 0 0;">
            <!-- clip-path: polygon(0 9%, 100% 0, 100% 100%, 0% 100%); -->
        </div>
        <AuthHeader></AuthHeader>
        <v-main style="z-index: 10;" class="h-screen d-flex align-center justify-center pa-4">
            <!-- <v-container fluid class="d-flex justify-center align-center" > -->

                        <v-card color="background" class="py-6 px-4 mx-auto border-sm" rounded="lg" style="width: 500px;">
                            <v-card-item>
                                <v-card-title class="text-center text-h5 text-md-h4 text-lg-h4 font-weight-bold text-capitalize">
                                    Welcome back!
                                </v-card-title>
                            </v-card-item>
                            <v-card-text>
                                <v-container>
                                    <!-- <div class="google-icon text-center mb-5 bg-white rounded-sm">
                                        <v-btn size="large" class="text-capitalize d-flex justify-space-around border-none"
                                            rounded="lg" block variant="outlined">
                                            <img src="https://imgs.search.brave.com/bdmCEEDU5vFEHnyuP6ebEB5TZx6UAjhIkxkswf1Jerg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4t/aWNvbnMtcG5nLmZy/ZWVwaWsuY29tLzI1/Ni8yODc1LzI4NzU0/MDQucG5nP3NlbXQ9/YWlzX3doaXRlX2xh/YmVs"
                                                width="20" height="20" class="me-2" alt="">
                                            Continue with Google
                                        </v-btn>
                                    </div> -->
                                    <div class="d-flex align-center mb-5">
                                        <v-divider></v-divider>
                                        <span class="px-4 text-medium-emphasis text-body-2">OR</span>
                                        <v-divider></v-divider>
                                    </div>
                                    <div class="mt-4">
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field clearable v-model="form.email" type="email"
                                                
                                                    prepend-inner-icon="mdi-email-outline"  variant="outlined" label="Work Email"
                                                    :error="errors.email ? true : false" :error-messages="errors?.email"
                                                    density="comfortable" color="primary"   />
                                            </v-col>

                                            <v-col cols="12">
                                                <v-text-field v-model="form.password"
                                                    :error="errors.password ? true : false"
                                                    :error-messages="errors?.password" type="password" clearable
                                                    prepend-inner-icon="mdi-lock-outline" variant="outlined" label="Password"
                                                    density="comfortable" color="primary" />
                                            </v-col>

                                            <v-col cols="12" class="mt-n5">
                                                <div
                                                    class="d-flex flex-column flex-sm-row justify-space-between align-start align-sm-center">
                                                    <v-checkbox color="primary" label="Remember me" class="text-body-2"
                                                        hide-details />
                                                    <v-btn color="primary"
                                                        to="forget" variant="text"
                                                        class="text-body-2 pa-0 mt-n2 mt-sm-0" size="small">
                                                        Forgot Password?
                                                    </v-btn>
                                                </div>
                                            </v-col>

                                            <v-col cols="12" class="">
                                                <v-btn @click="login()" color="primary" variant="flat" block
                                                    size="large" :loading="themeStore.loading" class="text-capitalize rounded-sm">
                                                    {{ themeStore.loading ? "Loading..." : "Log In" }}
                                                </v-btn>
                                            </v-col>

                                            <v-col cols="12" class="text-center pt-2">
                                               <p>
                                              Don't have an account?
                                              <span><router-link to="register" class="text-primary">Sign Up</router-link></span>
                                               </p>
                                               
                                            </v-col>
                                        </v-row>
                                    </div>
                                </v-container>
                            </v-card-text>
                        </v-card>
                 
            <!-- </v-container> -->
        </v-main>
    </v-app>
</template>

<script>
import { useThemeStore } from "@stores/themeStore";
import { useUserStore } from "@stores/userStore";
import { useAlertStore } from "@stores/alertStore";
import { useTheme } from "vuetify";
import Logo from "@assets/images/logo/logo.png";
import AuthHeader from "./AuthHeader.vue";
import { toRaw } from "vue";



export default {
    name: "Login",
    components: {
        AuthHeader
    },
    data() {
        return {
            logo: Logo,
            themeStore: useThemeStore(),
            userStore: useUserStore(),
            vuetify: useTheme(),
            alertStore: useAlertStore(),
            errors: {},
            loading: false,
            form: {
                email: "man411210@gmail.com",
                password: "12345678",
            },
        };
    },
    computed: {

    },
    mounted() {

        // console.log(toRaw(this.userStore.$state));
        this.$themeStore.startLoading()
        this.userStore.getProfile().then(() => {
            this.$themeStore.endLoading()
            this.$router.replace("/user/dashboard");
        }).catch(() => this.$themeStore.endLoading())
            
       
    },
    methods: {
        async login() {
            const themeStore = useThemeStore();

            themeStore.startLoading();
            this.errors = {};

            try {

                let response = await this.userStore.loginRequest(this.form);
                this.userStore.initializeUserSession(response.token,response.user);
                themeStore.endLoading();
                this.alertStore.add('Logged In Success', 'success');
                this.$router.replace("/user/dashboard");

            } catch (error) {
                themeStore.endLoading();
                this.errors = error.validation || {};
                this.alertStore.add(error.message, 'error');
            }
        },
    }

};
</script>
<style scoped>

    .pattern-bg {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px);
    background-size: 16px 16px;
    background-repeat: repeat;
    opacity: 0.25;
    pointer-events: none;
    z-index: 0;
}
</style>
