<template>
    <v-col cols="12">
        <v-card :loading="loading" :disabled="loading" class="border" title="Personal Information">
            <div class="border-b"></div>
            <v-card-text>
                <v-container fluid>
                    <v-row>
                        <v-col cols="12">
                            <div class="d-flex align-center">
                                <div class="pr-2">
                                    <img style="width:100px;height: 100px;" 
                                         class="border"
                                        :src="userStore.user.avatar" />
                                </div>
                                <div class="pl-3 pt-3">
                                    <v-btn color="primary" class=" text-capitalize" variant="flat">Update New Photo</v-btn>
                                    <p class="pt-3 text-light text-body-2">{{ UserModel.getField('avatar')?.placeholder }}</p>
                                </div>
                            </div>
                        </v-col>
                    </v-row>
                    <v-row class="mt-5">
                        <v-col cols="12">
                            <h2 class="text-body-1 text-light mb-1">User Information</h2>
                        </v-col>
                        <v-col v-for="(value, key) in UserModel.groupByFields('personal')" cols="12" md="4">
                            <label class="d-block pb-2" :for="value.label">{{ value.label }}</label>
                            <v-text-field 
                                v-model="form[value.key]" 
                                variant="outlined" 
                                color="primary"
                                density="compact" 
                                clearable />
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <h2 class="text-body-1 text-light mb-1">Company Information</h2>
                        </v-col>
                        <v-col v-for="(value, key) in UserModel.groupByFields('bussiness')" cols="12" md="4">
                               <label class="d-block pb-2" :for="value.label">{{ value.label }}</label>
                               
                               <v-select v-if="value.type == 'select'" 
                                    v-model="form[value.key]" 
                                    variant="outlined" 
                                    color="primary"
                                    :items="['yes','no']"
                                    density="compact" 
                                     />

                                <v-text-field v-else
                                v-model="form[value.key]" 
                                variant="outlined" 
                                color="primary"
                                density="compact" 
                                clearable />
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <h2 class="text-body-1 text-light mb-1">Proof Information</h2>
                        </v-col>
                        <v-col v-for="(value, key) in UserModel.groupByFields('proof')" cols="12" md="4">
                             <label class="d-block pb-2" :for="value.label">{{ value.label }}</label>
                             <v-file-input 
                                clearable 
                                v-model="form[value.key ?? []]" 
                                label="File input" 
                                density="comfortable"
                                variant="outlined" 
                                accept="image/*" 
                                color="primary"
                                prepend-icon="mdi-image"/>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <v-btn @click="onSubmit" class="bg-primary mr-2" variant="flat">Save Changes</v-btn>
                            <v-btn class="bg-background" variant="flat">Cancel</v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
    </v-col>
</template>

<script>
import UserModel from '@/models/User';
import authService from '@/services/authService';
import { useUserStore } from '@/stores/userStore';
import { toRaw } from 'vue';


export default {
    components: {

    },
    data() {
        return {
            userStore: useUserStore(),
            UserModel: UserModel,
            loading: false,
            form: {}
        };
    },
    computed: {

    },
    mounted() {

        UserModel.fields.map(res => (this.form[res.key] = ''));

        console.log(toRaw(this.form));
        this.loadDataFromProfile();

    },
    methods: {
        async loadDataFromProfile() {

            this.loading = true;

            authService.getProfile().then((res) => {
                let data = res.data.user
                for (const key in this.form) {
                    if (!Object.hasOwn(this.form, key)) continue;
                    const value = this.form[key];
                    if (['uploadID', 'motorTradeProof', 'addressProof'].includes(key)) {
                        continue;
                    }
                    if (Object.hasOwn(data, key)) {
                        this.form[key] = data[key];
                    } else {
                        this.form[key] = ''
                    }
                }
                this.loading = false;
            }).catch((error) => {
                this.loading = false;
            })

        },
        onSubmit() {

            authService.updateProfile(this.form).then((res) => {
                console.log(res);
            });
            // alert('asdasd');
            // this.loading = true;
            // console.log(toRaw(this.form));

        }

    }
};
</script>