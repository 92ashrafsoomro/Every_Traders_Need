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
                    <v-container>
                        <div class="google-icon text-center mb-7">
                            <v-btn class="text-capitalize" rounded="lg" block prepend-icon="mdi-google"  variant="outlined" >
                                Continue with Google
                            </v-btn>
                        </div>

                        <div class="mt-4">

                            <v-row>
                                <v-col cols="12" >
                                     <v-text-field clearable :model-value="form.email" type="email"
                                        prepend-inner-icon="mdi-email" variant="outlined" label="Work Email"
                                        :error="errors.email?true:false"
                                        :error-messages="errors?.email"
                                        />
                                </v-col>
                                <v-col cols="12" >
                                    <v-text-field :model-value="form.password" 
                                         :error="errors.password?true:false"
                                         :error-messages="errors?.password"
                                         type="password" clearable
                                         prepend-inner-icon="mdi-lock" 
                                         variant="outlined" 
                                         label="Password" />
                                </v-col>
                                <v-col cols="12" >
                                    <div class="d-flex justify-space-between">
                                        <div>
                                            <v-checkbox color="primary" label="Do you agree?" class="text-body-2" />
                                        </div>
                                        <div>
                                            <v-btn color="primary" to="http://localhost/autoboli/forgot-password" variant="text"
                                                class="text-body-2">Forgot Password?</v-btn>
                                        </div>
                                    </div>
                                </v-col>

                                <v-col cols="12" >
                                     <v-btn @click="login()" color="primary" variant="flat" block>
                                        {{ loading ?"Loading.." : "Log In" }}</v-btn>
                                </v-col>

                                 <v-col cols="12" class="text-center" >
                                        <span>Don’t have an account?</span>
                                        <v-btn variant="plain" class="px-0 text-body-2" color="primary">Sign up</v-btn>
                                 </v-col>
                            </v-row>
                        </div>
                    </v-container>
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
