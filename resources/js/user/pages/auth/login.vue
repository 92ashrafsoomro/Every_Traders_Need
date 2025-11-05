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
                            <v-btn class="text-capitalize" rounded="lg" block prepend-icon="mdi-google"
                                variant="outlined">
                                Continue with Google
                            </v-btn>
                        </div>
                        <div class="mt-4">
                            <v-row>

                                <v-col cols="12">
                                    <v-text-field clearable v-model="form.email" type="email"
                                        prepend-inner-icon="mdi-email" variant="outlined" label="Work Email"
                                        :error="errors.email ? true : false" :error-messages="errors?.email" />
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field v-model="form.password" :error="errors.password ? true : false"
                                        :error-messages="errors?.password" type="password" clearable
                                        prepend-inner-icon="mdi-lock" variant="outlined" label="Password" />
                                </v-col>
                                <v-col cols="12">
                                    <div class="d-flex justify-space-between">
                                        <div>
                                            <v-checkbox color="primary" label="Do you agree?" class="text-body-2" />
                                        </div>
                                        <div>
                                            <v-btn color="primary" to="http://localhost/autoboli/forgot-password"
                                                variant="text" class="text-body-2">Forgot Password?</v-btn>
                                        </div>
                                    </div>
                                </v-col>

                                <v-col cols="12">
                                    <v-btn @click="login()" color="primary" variant="flat" block>
                                        {{ loading ? "Loading.." : "Log In" }}</v-btn>
                                </v-col>

                                <v-col cols="12" class="text-center">
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
import { useUserStore } from "@stores/userStore";
import { useAlertStore } from "@stores/alertStore";
import { useTheme } from "vuetify";
import Logo from "../../../images/logo/logo.png";


export default {
    name: "Login",
    components: {

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
                    
                let loginResponse = await this.userStore.loginUser(this.form);
                let token = loginResponse.token;
                let profileRequest = await this.userStore.getProfile(token);
                this.userStore.setToken(token);

               
                this.loading = false;
                this.alertStore.add('Logged In Succeess','success');
                this.$router.replace("/dashboard");

            } catch (error) {
                this.loading = false;
                this.errors = error.validation || {};
                this.alertStore.add(error.message,'error');
            }
        },
    },
};
</script>
<style scoped></style>
