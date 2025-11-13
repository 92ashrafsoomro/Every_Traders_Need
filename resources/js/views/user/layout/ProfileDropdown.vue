<template>
    <v-menu class="menuLabel" location="bottom" transition="fade-transition">
        <template #activator="{ props }">
            <v-btn icon v-bind="props" class="profileBtn">
                <div class="d-flex align-center ga-2">
                    <div class="profileImage d-flex justify-center align-center">
                        <img src="/public/theme/assets/test_profileImage.jpg" alt="" class="rounded"
                            style="height: 80%; width: 80%;" />
                    </div>
                    <slot></slot>
                </div>
            </v-btn>
        </template>

        <v-list class="" style="min-width: 224px">
            <v-list-item>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex justify-start align-center ps-2 ga-2">
                        <div class="profileImage d-flex justify-center align-center">
                            <img :src="userStore.user.avatar" class="h-100 w-100 rounded-circle position-static" />
                        </div>
                        <div>
                            <div class="profile-name text-h6">
                                {{userStore.user.name}}
                            </div>
                            <div class="profile-type text-caption">
                                 {{userStore.user.user_type}}
                            </div>
                        </div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2 wrapper">
                        <v-icon icon="mdi-account-outline text-light_text_on"></v-icon>
                        <p class="text-light_text_on">My Profile</p>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2">
                        <v-icon icon="mdi-cog-outline text-light_text_on"></v-icon>
                        <p class="text-light_text_on">Settings</p>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2 ">
                        <v-icon icon="mdi-credit-card-outline text-light_text_on"></v-icon>
                        <p class="text-light_text_on">Billings</p>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item>
                <v-list-item-title class="">
                    <!-- <v-btn @click="logOut()" size="large" class="ml-n3" prepend-icon="mdi-logout"
                        style="font-size: smaller;">
                        <p class="">Logout</p>
                    </v-btn> -->
                    <div @click="logOut()" class="d-flex align-center ga-2 cursor-pointer">
                        <v-icon icon="mdi-logout text-light_text_on"></v-icon>
                        <p class="text-light_text_on">Logout</p>
                    </div>
                </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script>
import {useUserStore} from '@stores/userStore'

export default {
    name: "my-component",
    data() {
        return {
            userStore: useUserStore(),
        };
    },
    methods: {
        logOut() {
            localStorage.removeItem("auth_token");
            this.$alertStore.add("Logged Out Successfully","success");
            this.$router.push("/login");

        }
    }
};
</script>
<style>
.profileImage {
    height: 45px;
    width: 45px;
}
</style>
