<template>
    <v-menu class="menuLabel" location="bottom" transition="fade-transition">
        <template #activator="{ props }">
            <v-btn icon v-bind="props" class="profileBtn">
                <div class="profileImage">
                    <img
                        src="/public/theme/assets/test_profileImage.jpg"
                        alt=""
                        class="profile-img"
                    />
                </div>
            </v-btn>
        </template>

        <v-list
            style="min-width: 224px; background-color: #000f21; color: #b2c0ce"
        >
            <v-list-item>
                <v-list-item-title>
                    <div class="profileTitle">
                        <div class="profileImage">
                            <img
                                src="/public/theme/assets/test_profileImage.jpg"
                                alt=""
                                class="profile-img"
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
            <v-list-item>
                <v-list-item-title>
                    <div class="nestItem">
                        <span class="material-symbols-outlined">
                            contact_page
                        </span>
                        <div>My Profile</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item>
                <v-list-item-title>
                    <div class="nestItem">
                        <span class="material-symbols-outlined">
                            settings
                        </span>
                        <div>Settings</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item>
                <v-list-item-title>
                    <div class="nestItem">
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
                    <button
                        class="btn btn-danger d-inline-flex align-self-center gap-2"
                        @click="logout"
                    >
                        Logout
                        <span class="material-symbols-outlined"> logout </span>
                    </button>
                </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script></script>
<style>
.profileTitle {
    display: flex;
    align-items: center;
    justify-content: start;
    column-gap: 10px;
    padding: 0px 10px;
}
.profileImage {
    height: 50px;
    width: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profileImage .profile-img {
    height: 100%;
    width: 100%;
    background-position: 100%;
    border-radius: 50px;
}
.nestItem {
    display: flex;
    align-items: center;
    column-gap: 10px;
}
</style>
