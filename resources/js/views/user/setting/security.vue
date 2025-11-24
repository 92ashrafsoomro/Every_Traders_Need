<template>
    <v-col cols="12">

        <custom-card title="Change Password" class="bg-surface">
            <v-container fluid>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field 
                            append-inner-icon="mdi-eye" 
                            label="Current Password"
                            v-model="form.current_password" 
                            :type="toggle_password ? 'text' : 'password'"
                            @click:append-inner="toggle_password = !toggle_password" 
                            variant="outlined" 
                            color="primary"
                            density="compact" />

                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field append-inner-icon="mdi-eye" label="New Password" v-model="form.new_password"
                            :type="toggle_new_password ? 'text' : 'password'"
                            @click:append-inner="toggle_new_password = !toggle_new_password" variant="outlined"
                            color="primary" density="compact" />

                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field append-inner-icon="mdi-eye" label="Confirm New Password"
                            v-model="form.confirm_password" :type="toggle_confirm_Password ? 'text' : 'password'"
                            @click:append-inner="toggle_confirm_Password = !toggle_confirm_Password" variant="outlined"
                            color="primary" density="compact" />
                    </v-col>

                    <v-col cols="12">
                        <h4 class="text-h6 font-weight-thin">Password Requirements:</h4>
                        <ul class="pt-2 ml-5 text-body-2 font-weight-thin">
                            <li class="py-1">Minimum 8 characters long - the more, the better</li>
                            <li class="py-1">At least one lowercase character</li>
                            <li class="py-1">At least one number, symbol, or whitespace character</li>
                        </ul>

                        <div class="my-3">
                            <v-btn class="bg-primary mr-2" variant="flat">Save Changes</v-btn>
                        </div>

                    </v-col>
                </v-row>
            </v-container>
        </custom-card>
    </v-col>

    <v-col cols="12">

        <custom-card title="Recent Devices" class="">
            <v-data-table-server class="pb-3" :headers="pageStore.recentDevices.headers"
                :items="pageStore.recentDevices.data" :items-length="pageStore.recentDevices.total"
                :loading="pageStore.recentDevices.loading" item-value="id">
                <template #item.platform="{ item }">
                    <p>
                        <v-icon class="text-primary" icon="mdi-microsoft-windows-classic" />
                        <span class="px-2 font-weight-thin"> {{ item.platform }}</span>
                    </p>
                </template>
                <template #item.browser="{ item }">
                    <p>
                        <v-icon class="text-orange" icon="mdi-google-chrome" />
                        <span class="px-2 font-weight-thin"> {{ item.browser }}</span>
                    </p>
                </template>

                <template v-slot:bottom>
                    <div class="py-2">
                        <custom-pagination :loading="pageStore.recentDevices.loading"
                            v-model:page="pageStore.recentDevices.page" :lastPage="pageStore.recentDevices.last_page" />
                    </div>
                </template>
            </v-data-table-server>
        </custom-card>

    </v-col>
</template>
<script>
import {
    useUserStore
} from '@/stores/userStore';
import {
    usePageStore
} from '@/stores/pageStore';

export default {
    components: {

    },
    data() {
        return {
            userStore: useUserStore(),
            pageStore: usePageStore(),
            toggle_password: true,
            toggle_new_password: true,
            toggle_confirm_Password: true,

            loading: false,
            form: {
                current_password: '',
                new_password: '',
                confirm_password: '',

                firstName: '',
                surname: '',
                title: '',
                jobTitle: '',
                avatar: '',
                phone: '',

                companyName: '',
                companyAddress1: '',
                companyAddress2: '',
                businessType: '',
                motorTradeInsurance: '',
                businessEmail: '',

                telephone: '',
                townCity: '',
                country: '',
                website: '',
                postcode: '',
            }

        };
    },
    computed: {

    },
    mounted() {

        this.loadDataFromProfile();
    },
    methods: {
        loadDataFromProfile() {
            for (const key in this.form) {
                if (!Object.hasOwn(this.form, key)) continue;
                const value = this.form[key];

                if (Object.hasOwn(this.userStore.user, key)) {
                    this.form[key] = this.userStore.user[key];
                } else {
                    this.form[key] = ''
                }
            }
        }
    }
};
</script>
