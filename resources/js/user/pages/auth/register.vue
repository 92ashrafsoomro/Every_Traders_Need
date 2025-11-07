<template>

    <v-app>
             <AuthHeader></AuthHeader>

                 <div class="h-screen d-flex flex-column align-center justify-center">
                    <h1>Autoboli</h1>
                    <v-btn append-icon="$vuetify" size="large" variant="tonal" class="text-white" to="/login">
                        Login
                    </v-btn>
                </div>
    </v-app>

</template>
<script>
import AuthHeader from './AuthHeader.vue';

export default {
    name: "Register",
    components: {
        AuthHeader
    },
    data() {
        return {

        };
    },
    computed: {

    },
    methods: {

    },
};
</script>
<style></style>