<template>
    <v-app class="bg-surface">
        <v-app-bar class="px-5" flat>
            <template v-slot:prepend>
                <v-img width="130" :src="logo"></v-img>
            </template>
            <template v-slot:append>
                <v-btn @click="toggleTheme()" v-if="vuetify.global.name == 'adminDark'" icon="md:light_mode"></v-btn>
                <v-btn @click="toggleTheme()" v-if="vuetify.global.name == 'adminLight'" icon="md:dark_mode"></v-btn>
                <v-btn color="primary" variant="flat">Back To Home</v-btn>
            </template>
        </v-app-bar>

        <v-main>
            <v-card color="background" class="mx-auto my-8 py-6" elevation="16" max-width="500" rounded="sm">
                <v-card-item>
                    <v-card-title class="text-center text-h4">
                      Welcome back!
                    </v-card-title>
                </v-card-item>
                <v-card-text>
                            <div class="google-icon text-center">
                                <v-btn color="background" >
                                        <v-img width="30" src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"></v-img>
                                    <span class="pl-4" >Continue with Google</span>
                                </v-btn>
                            </div>

                             <v-text-field clearable prepend-icon="mdi-email" variant="outlined" v-model="firstName" label="Work Email"></v-text-field>
                             <v-text-field clearable prepend-icon="mdi-email" variant="outlined" v-model="lastName" label="Password"></v-text-field>
                             <div class="d-flex justify-space-between">
                                <div>
                                    <v-checkbox
                                    v-model="checkbox"
                                    :rules="[v => !!v || 'You must agree to continue!']"
                                    label="Do you agree?"
                                    required
                                ></v-checkbox>
                                </div>
                                <div>
                                    <v-btn to="http://localhost/autoboli/forgot-password" variant="text" class="text-body-1" >Forgot Password?</v-btn>
                                </div>
                             </div>

                                    <div class="form-group">
                                        <label>Work Email</label>
                                        <input v-model="form.email" type="email" class="form-control"
                                            placeholder="Enter your work email" />
                                        <p v-if="errors.email" class="text-danger">
                                            {{ errors.email[0] }}
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" v-model="form.password" name="password"
                                            class="form-control" placeholder="Enter password" />
                                        <p v-if="errors.password" class="text-danger">
                                            {{ errors.password[0] }}
                                        </p>
                                    </div>

                                    <div class="my-2 d-flex align-items-center justify-content-between text-sm">
                                        <label class="inline align-items-center gap-2">
                                            <input type="checkbox" id="rememberMe" class="rounded" />
                                            <span class="text-white dark:text-gray-700">Remember me</span>
                                        </label>
                                        
                                    </div>

                                    <div class="d-flex align-items-end" >
                                        <a href="http://localhost/autoboli/forgot-password" class="text-body-1">Forgot
                                            Password?</a>
                                    </div>

                                        <div class="text-center">
                                    <v-btn @click="login()" color="primary" variant="flat" >{{ loading ? "Loading.." : "Log In" }}</v-btn>
                                </div>
                                
                                <p class="mt-3 text-body-2 text-center ">
                                    Don’t have an account?
                                    <a href="#" class="font-semibold">Sign up</a>
                                </p>

                </v-card-text>
               
            </v-card>
        </v-main>
    </v-app>
</template>

<script>
import { useThemeStore } from "../../../stores/theme";
import { useUserStore } from "../../../stores/user";
import LoginHeader from "./LoginHeader.vue";
import AuthService from "../../../core/services/authService";
import { useTheme } from "vuetify";
import Logo from "../../../images/logo/logo.png";

export default {
    name: "Login",
    components: {
        LoginHeader,
    },
    data() {
        return {
            logo: Logo,
            themeStore: useThemeStore(),
            userStore: useUserStore(),
            vuetify: useTheme(),
            errors: {},
            loading: false,
            form: {
                email: "man411210@gmail.com",
                password: "12345678",
            },
        };
    },
    computed: {},
    methods: {
        toggleTheme() {
            if (this.vuetify.global.name == "adminDark") {
                this.vuetify.change("adminLight");
            } else {
                this.vuetify.change("adminDark");
            }
        },
        async login() {
            this.loading = true;
            this.errors = {};

            try {
                let loginResponse = await AuthService.Login(this.form);
                let profileRequest = await AuthService.getProfile(
                    loginResponse.token
                );
                profileRequest.token = loginResponse.token;
                this.userStore.userLogin(profileRequest);
                this.loading = false;
                this.$router.replace("/dashboard");
            } catch (error) {
                this.loading = false;
                this.errors = error.validation || {};
                alert(error.message);
            }
        },
    },
};
</script>

<style scoped>
/* .theme-mode-dark{
        background-color: #000F21;
    }

    .theme-mode-light{
        background-color: #f3f4f6;
    }

    .card{
        padding: 18px 40px;
        padding-top: 30px;
        max-width:512px;
        margin: auto;
        border-radius: 0.25rem;
        background:#0f1c2c;
    }

    .card h1{
        font-size: 1.875rem;
        line-height: 2.25rem;
        color: white;
        margin-bottom: 10px;
    }

    .google-icon{
        width: 100%;
        text-align: center;
        border: 1px solid white;
        border-radius: 8px;
        padding: 10px;
    }

    .google-icon a{
        text-decoration: none;
    
    }

    .google-icon a span{
        text-decoration: none;
        color: white;
        font-weight: 500;
    }

    .google-icon img{
        width: 31px;
        padding-right: 11px;
    }

    .divider{
        color: white;
        display: flex;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .divider span{
        border-bottom: 1px solid #686d79;
        display: block;
        width: 100%;
        
    }

    .divider p{
        margin: 0px;
        font-size: 12px;
        padding: 0px 10px;
        font-weight: 700;
    }

 
    /* Form */
/* label{
        color: white;
        padding-bottom: 10px;
        font-weight: 700;
        font-size: 12px;

    }

    form a{
        text-decoration: none;
    }

    .form-group{
      margin-bottom: 10px;     
    }

    input{
        background: #000F21;
    }

    input:focus {
        background: #000F21!important;
    }

    input::placeholder {
        color: #999; 
        opacity: 1;  
    }  */
</style>
