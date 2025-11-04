<template>
    <v-menu class="menuLabel" location="bottom" transition="fade-transition">
        <template #activator="{ props }">
            <v-btn icon v-bind="props" class="profileBtn">
                <div class="profileImage d-flex justify-center align-center">
                    <img
                        src="/public/theme/assets/test_profileImage.jpg"
                        alt=""
                        class="h-75 w-75 rounded-circle"
                    />
                </div>
            </v-btn>
        </template>

        <v-list
            class="bg-secondary text-grey-lighten-2"
            style="min-width: 224px"
        >
            <v-list-item>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex justify-start align-center ps-2 ga-2">
                        <div
                            class="profileImage d-flex justify-center align-center"
                        >
                            <img
                                src="/public/theme/assets/test_profileImage.jpg"
                                alt=""
                                class="h-100 w-100 rounded-circle position-static"
                            />
                        </div>
                        <div class="profileTitle-title">
                            <div class="profile-name text-h6 text-white">
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
                        <span class="material-symbols-outlined">
                            contact_page
                        </span>
                        <div>My Profile</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2">
                        <span class="material-symbols-outlined">
                            settings
                        </span>
                        <div>Settings</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2">
                        <span class="material-symbols-outlined">
                            request_quote
                        </span>
                        <div>Billings</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item>
                <v-list-item-title class="">
                    <v-btn size="small" color="danger" class="text-white">
                        <p class="text-caption mr-2">Logout</p>
                        <svg-icon
                            type="mdi"
                            :path="path"
                            width="14"
                            height="14"
                        ></svg-icon>
                    </v-btn>
                </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script>
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiLogout } from "@mdi/js";

export default {
    name: "my-component",
    components: {
        SvgIcon,
    },
    data() {
        return {
            path: mdiLogout,
        };
    },
};
</script>
<style>
.profileImage {
    height: 45px;
    width: 45px;
}
</style>
