<template>
    <v-menu class="menuLabel" location="bottom" transition="fade-transition">
        <template #activator="{ props }">
            <v-btn icon v-bind="props" class="profileBtn">
                <div class="profileImage d-flex justify-center align-center">
                    <img src="/public/theme/assets/test_profileImage.jpg" alt="" class="h-75 w-75 rounded-circle" />
                </div>
            </v-btn>
        </template>

        <v-list class="" style="min-width: 224px">
            <v-list-item>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex justify-start align-center ps-2 ga-2">
                        <div class="profileImage d-flex justify-center align-center">
                            <img src="/public/theme/assets/test_profileImage.jpg" alt=""
                                class="h-100 w-100 rounded-circle position-static" />
                        </div>
                        <div>
                            <div class="profile-name text-h6">
                                Babar Azam
                            </div>
                            <div class="profile-type text-caption">
                                User Type
                            </div>
                        </div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2">
                        <v-icon icon="mdi-account"></v-icon>
                        <div>My Profile</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2">
                        <v-icon icon="mdi-cog"></v-icon>
                        <div>Settings</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2">
                        <v-icon icon="mdi-currency-usd"></v-icon>
                        <div>Billings</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item>
                <v-list-item-title class="">
                    <v-btn @click="logOut()" size="small" color="danger" class="text-white">
                        <p class="text-caption mr-2">Logout</p>
                        <svg-icon type="mdi" :path="path" width="14" height="14"></svg-icon>
                    </v-btn>
                </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script>
import { useAlertStore } from "@/stores/alertStore";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiLogout } from "@mdi/js";
import {useUserStore} from '@stores/userStore'

export default {
    name: "my-component",
    components: {
        SvgIcon,
    },
    data() {
        return {
            path: mdiLogout,
            userStore: useUserStore(),
            alertStore: useAlertStore(),
        };
    },
    methods: {
        logOut() {
            localStorage.removeItem("auth_token");
            this.alertStore.add("Logged Out Successfully","success");
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
