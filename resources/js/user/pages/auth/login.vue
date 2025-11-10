<template>
    <v-app class="bg-surface">
        <div class="position-absolute bottom-0 left-0 right-0 h-50 bg-primary"
            style="z-index: 0; clip-path: polygon(0 29%, 100% 0, 100% 100%, 0% 100%);">
        </div>
        <AuthHeader></AuthHeader>
        <v-main style="z-index: 10;" class="h-screen d-flex align-center justify-center">
            <v-container fluid class="d-flex justify-center align-center">

                <v-row justify="center">
                    <v-col cols="12" sm="8" md="6" lg="4">
                        <v-card color="background" class="py-6 px-4" elevation="10" rounded="lg">
                            <v-card-item>
                                <v-card-title class="text-center text-h5 text-md-h3 font-weight-medium text-capitalize">
                                    Welcome back!
                                </v-card-title>
                            </v-card-item>
                            <v-card-text>
                                <v-container>
                                    <div class="google-icon text-center mb-5">
                                        <v-btn size="large" class="text-capitalize" rounded="lg" block
                                            prepend-icon="mdi-google" variant="outlined">
                                            Continue with Google
                                        </v-btn>
                                    </div>
                                    <div class="d-flex align-center mb-5">
                                        <v-divider></v-divider>
                                        <span class="px-4 text-medium-emphasis text-body-2">OR</span>
                                        <v-divider></v-divider>
                                    </div>
                                    <div class="mt-4">
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field clearable v-model="form.email" type="email"
                                                    prepend-inner-icon="mdi-email" variant="outlined" label="Work Email"
                                                    :error="errors.email ? true : false" :error-messages="errors?.email"
                                                    density="outlined" color="primary" />
                                            </v-col>

                                            <v-col cols="12">
                                                <v-text-field v-model="form.password"
                                                    :error="errors.password ? true : false"
                                                    :error-messages="errors?.password" type="password" clearable
                                                    prepend-inner-icon="mdi-lock" variant="outlined" label="Password"
                                                    density="outlined" color="primary" />
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
                                                    size="large" :loading="themeStore.loading">
                                                    {{ themeStore.loading ? "Loading..." : "Log In" }}
                                                </v-btn>
                                            </v-col>

                                            <v-col cols="12" class="text-center pt-2">
                                                <span class="text-body-2">Don't have an account?</span>
                                                <v-btn to="/register" variant="plain" class="px-1 text-body-2"
                                                    color="primary" size="small">
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
import { useThemeStore } from "../../../stores/themeStore";
import { useUserStore } from "@stores/userStore";
import { useAlertStore } from "@stores/alertStore";
import { useTheme } from "vuetify";
import Logo from "../../../images/logo/logo.png";
import AuthHeader from "./AuthHeader.vue";



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
    methods: {
        async login() {
            const themeStore = useThemeStore();

            themeStore.startLoading();
            this.errors = {};

            try {
                let loginResponse = await this.userStore.loginUser(this.form);
                let token = loginResponse.token;
                let profileRequest = await this.userStore.getProfile(token);
                this.userStore.setToken(token);

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
<style scoped></style>
