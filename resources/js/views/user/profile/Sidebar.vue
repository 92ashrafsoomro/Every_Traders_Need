<template>

    <v-card class="border" max-width="450px">
       <div class="d-flex justify-space-between align-center pa-4">
                <h2 class="text-h6 font-weight-medium">Account Detail</h2>
                <div class="d-flex align-center ga-3">
                    <v-chip :to="'/user/settings/profile'" color="primary" size="small" class="font-weight-bold text-caption">
                        Edit   
                    </v-chip>
               
                </div>
            </div>
          <div class="border-b"></div>

        <v-card-text>

            <v-container class="pa-2">

                <h2 class="text-body-1 text-light  mb-3 ">User Information</h2>
                <!-- <v-divider class="border-opacity-30 mb-4" color="grey" /> -->
                <v-row>
                    <v-col cols="12" class="">
                        <div v-for="(item, i) in UserModel.fields.filter((item) => item.group == 'personal').filter((item) => ['firstName', 'phone', 'jobTitle', 'personalEmail'].includes(item.key))"
                            :key="i" class=" d-flex align-center mb-6">
                            <v-icon color="whiteLite" class="mr-4  ">{{ item.icon }}</v-icon>
                            <div class="d-flex align-center flex-wrap">
                                <div class="text-body-2 text-light  pr-2">{{ item.label }} :</div>
                                <div v-if="!item.download" class="text-body-2 text-whiteLite">
                                    {{ userStore.user[item.key] }}
                                </div>

                            </div>
                        </div>
                    </v-col>
                </v-row>

                <v-divider class="pa-2 mt-3"></v-divider>

                <!-- Personal Information -->
                <h2 class="text-body-1 text-light my-3 mb-3">Company Information</h2>

                <v-row>
                    <v-col cols="12">
                        <div v-for="(item, i) in UserModel.fields.filter((item) => item.group == 'bussiness')" :key="i"
                            class="d-flex align-center mb-6">
                            <v-icon color="whiteLite" class="mr-4 ">{{ item.icon }}</v-icon>
                            <div class="d-flex align-center flex-wrap">
                                <div class="text-body-1 text-light">{{ item.label }} : </div>
                                <div class=" text-body-2 text-whiteLite font-weight-medium"> {{ userData?.[item.key] }}
                                </div>
                            </div>
                        </div>
                    </v-col>
                </v-row>
                <v-divider class="pa-2 mt-3"></v-divider>
                <h2 class="text-body-1 text-light mt-3  mb-3 ">Business Proof</h2>
                <v-row>
                    <v-col cols="12" class="">

                        <div v-for="(item, i) in UserModel.fields.filter((item) => item.group == 'proof')" :key="i"
                            class=" d-flex align-center mb-6">
                            <v-icon color="whiteLite" class="mr-4 ">mdi-text-box-outline</v-icon>
                            <div class="d-flex align-center">
                                <div class="text-body-2 text-light pr-2">{{ item.label }} :</div>
                                <div class="text-body-2">
                                    <v-btn variant="text" size="small" target="_blank" color="primary"
                                        :href="userStore.user[item.key]"
                                        class="text-capitalize text-body-2 text-decoration-underline ">
                                       View
                                    </v-btn>
                                </div>

                            </div>
                        </div>
                    </v-col>
                </v-row>

            </v-container>
        </v-card-text>
    </v-card>
</template>

<script>
import General from '@/models/general.model';
import UserModel from '@/models/user.model';
import { useUserStore } from '@/stores/userStore';
import { toRaw } from 'vue';

export default {
    name: 'CompanyProfile',

    data() {
        return {
            userStore: useUserStore(),
            UserModel: UserModel,
            userData: null,
        }
    },
    computed: {
        companyItems() {

            return [
                { icon: 'mdi-office-building', label: 'Business Name', value: this.userData.companyName },
                { icon: 'mdi-web', label: 'Business Type', value: this.userData.businessType },
                { icon: 'mdi-earth', label: 'Website', value: this.userData.website },
                { icon: 'mdi-email-outline', label: 'Business Email', value: this.userData.businessEmail },
                { icon: 'mdi-shield-check', label: 'Motor Trade Insurance', value: this.userData.motorTradeInsurance },
                { icon: 'mdi-card-bulleted-outline', label: 'VAT Number', value: this.userData.vatNumber },
                { icon: 'mdi-home-city', label: 'Company Address 1', value: this.userData.companyAddress1 },
                { icon: 'mdi-home-city-outline', label: 'Company Address 2', value: this.userData.companyAddress2 },
                { icon: 'mdi-map-marker', label: 'Town/City', value: this.userData.townCity },
                { icon: 'mdi-flag', label: 'Country', value: this.userData.country },
                { icon: 'mdi-mailbox', label: 'Postcode / Zip code', value: this.userData.postcode },
                { icon: 'mdi-phone', label: 'Telephone', value: this.userData.telephone }
            ];
        },
        personalItems() {

            return [
                { icon: 'mdi-account', label: 'Full Name', value: this.userStore.user.firstName + ' ' + this.userStore.user.surname },
                { icon: 'mdi-phone', label: 'Job Title', value: this.userStore.user.jobTitle },
                { icon: 'mdi-cellphone', label: 'Phone Number', value: this.userStore.user.phone },
                { icon: 'mdi-email', label: 'Email', value: this.userStore.user.personalEmail },
            ];

        }

    },
    mounted (){
        this.getUserData()
    },
    methods: {
      async getUserData() {
    this.loading = true;
    try {
        let res = await General.get('/api/profile/account-details/' + this.userStore.user.id);
              this.userData = res.data.user;
              console.log(toRaw( this.userData));
              
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
            }
        },
        downloadFile(label) {
            // Simulate file download
            alert(`Downloading ${label}...`)
            // In real app: window.location.href = '/api/download/' + label.toLowerCase().replace(/\s+/g, '-')
        }
    }
}
</script>

<style scoped></style>