<template>
    <v-app class="bg-surface">
        <v-app-bar class="px-3 px-sm-5" flat>
            <template v-slot:prepend>
                <v-btn to="/">
                    <v-img width="130" :src="logo" to="/"></v-img>
                </v-btn>
            </template>
            <template v-slot:append>
                <v-btn @click="toggleTheme()" v-if="vuetify.global.name == 'adminDark'" icon="mdi-lightbulb-on"></v-btn>
                <v-btn @click="toggleTheme()" v-if="vuetify.global.name == 'adminLight'"
                    icon="mdi-lightbulb-off"></v-btn>
                <v-btn color="primary" variant="flat" to="/" class="d-none d-sm-flex">
                    Back To Home
                </v-btn>
                <v-btn color="primary" variant="flat" to="/" icon="mdi-home" class="d-flex d-sm-none"></v-btn>
            </template>
        </v-app-bar>

        <v-main class="d-flex justify-center align-center">
            <v-container>
                <v-row justify="center">
                    <v-col cols="12" sm="10" md="8" lg="5" xl="5">
                        <v-card color="background" class="my-8 py-3" elevation="8" rounded="sm">
                            <v-card-item>
                                <v-card-title class="text-center text-h5 text-sm-h4 font-weight-bold">
                                    Welcome back!
                                </v-card-title>
                            </v-card-item>

                            <v-card-text>
                                <v-container>
                                    <!-- Google Sign In -->
                                    <div class="google-icon text-center mb-2 mb-sm-4">
                                        <v-btn class="text-capitalize" rounded="lg" block prepend-icon="mdi-google"
                                            variant="outlined" size="large">
                                            Continue with Google
                                        </v-btn>
                                    </div>

                                    <!-- Divider -->
                                    <div class="d-flex align-center mb-3">
                                        <v-divider></v-divider>
                                        <span class="px-4 text-medium-emphasis text-body-2">OR</span>
                                        <v-divider></v-divider>
                                    </div>

                                    <!-- Login Form -->
                                    <div class="mt-4">
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field clearable v-model="form.email" type="email"
                                                    prepend-inner-icon="mdi-email" variant="outlined" label="Work Email"
                                                    :error="errors.email ? true : false" :error-messages="errors?.email"
                                                    density="comfortable" />
                                            </v-col>

                                            <v-col cols="12">
                                                <v-text-field v-model="form.password"
                                                    :error="errors.password ? true : false"
                                                    :error-messages="errors?.password" type="password" clearable
                                                    prepend-inner-icon="mdi-lock" variant="outlined" label="Password"
                                                    density="comfortable" />
                                            </v-col>

                                            <v-col cols="12" class="mt-n5">
                                                <div
                                                    class="d-flex flex-column flex-sm-row justify-space-between align-start align-sm-center">
                                                    <v-checkbox color="primary" label="Remember me" class="text-body-2"
                                                        hide-details />
                                                    <v-btn color="primary"
                                                        to="http://localhost/autoboli/forgot-password" variant="text"
                                                        class="text-body-2 pa-0 mt-n2 mt-sm-0" size="small">
                                                        Forgot Password?
                                                    </v-btn>
                                                </div>
                                            </v-col>

                                            <v-col cols="12" class="pt-4">
                                                <v-btn @click="login()" color="primary" variant="flat" block
                                                    size="large" :loading="loading">
                                                    {{ loading ? "Loading..." : "Log In" }}
                                                </v-btn>
                                            </v-col>

                                            <v-col cols="12" class="text-center pt-2">
                                                <span class="text-body-2">Don't have an account?</span>
                                                <v-btn variant="plain" class="px-1 text-body-2" color="primary"
                                                    size="small">
                                                    Sign up
                                                </v-btn>
                                            </v-col>
                                        </v-row>
                                    </div>
                                </v-container>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
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
    computed: {
        isDark() {
            return this.vuetify.global.name === "adminDark";
        },
        isLight() {
            return this.vuetify.global.name === "adminLight";
        },
    },
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
                this.alertStore.add('Logged In Succeess', 'success');
                this.$router.replace("/user/dashboard");

            } catch (error) {
                this.loading = false;
                this.errors = error.validation || {};
                this.alertStore.add(error.message, 'error');
            }
        },
    },
};
</script>
<style scoped></style>
