<template>
    <div class=" w-100 h-100 bg-surface   pb-8" style="position: absolute; overflow: hidden;">
        <div class="pattern-bg"></div>
        <div class="position-relative  pt-5  " style=" max-width: 1400px; z-index: 10">

            <slot> </slot>
        </div>
    </div>
    <v-app>
        <div class="position-absolute bottom-0 left-0 right-0 h-50 bg-primary"
            style="z-index: 0; border-radius:  0 300px 0 0; ">
            <!-- clip-path: polygon(0 9%, 100% 0, 100% 100%, 0% 100%); -->
        </div>
        <AuthHeader />

        <v-main class="z-index-1" style="overflow: hidden;">
            <div class="mt-14">
                <div class="text-center ">
                    <h1 class="text-h4 text-md-h3 font-weight-bold text-whiteLite mb-4 ">Create your Account
                    </h1>
                    <!-- <p class="text-lg-h6 text-body-1 mt-2 text-light_text_on">Built for dealers & traders — fast
                        onboarding, powerful
                        insights.</p> -->
                </div>
            </div>
            <div class="stepper d-lg-flex d-md-flex d-none justify-space-between h-[200px] w- mx-auto  pa-4  mt-6 rounded-sm"
                style="max-width: 800px;  background-color: rgb(var(--v-theme-primary),0.2);">

                <div v-for="(label, index) in steps" :key="index"
                    class="step align-lg-center ga-3 d-lg-flex position-relative"
                    :class="{ active: step === index + 1, done: step > index + 1 }">
                    <div class="circle ma-auto d-flex align-center justify-center " style="width: 36px;   
                        height: 36px;
                        border: 1px solid rgb(var(--v-theme-primary));">{{ index + 1 }}</div>
                    <div class=" ">
                        <div class="text-start">
                            {{ label.label }}
                        </div>
                        <div class="text-body-2 text-light_text_on text-start">
                            {{ label.subHeading }}
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-center pb-6 mt-2 pa-4 ">
                <v-progress-linear class="progress" :model-value="step" :max="steps.length" height="5"
                    style="max-width: 800px;" color="primary"></v-progress-linear>
            </div>
            <v-container fluid class="d-flex flex-column ">



                <v-row justify="center " class=" pa-4 ">

                    <v-col cols="12" sm="10" md="8" lg="6" xl="5" class="border bg-background position-relative"
                        style="padding: 0; z-index: 5;">

                        <!-- Step 1 -->
                        <div v-if="step === 1" class="pa-7">
                            <div class="">
                                <h2 class="text-lg-h4 text-md-h4 text-h5 font-weight-bold mb-n2 ">Company
                                    Information</h2>
                                <p class="text-body-2 mt-3">
                                    Provide your company details.
                                </p>
                                <v-container fluid class="py-6 px-0">
                                    <v-row class="gap-4" justify="start">
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.companyName"
                                                :error-messages="errors?.companyName" variant="outlined"
                                                density="comfortable" label="Company / Business Name" color="primary"
                                                clearable required />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.companyAddress1"
                                                :error-messages="errors?.companyAddress1" variant="outlined"
                                                density="comfortable" label="Company Address" color="primary"
                                                clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.companyAddress2"
                                                :error-messages="errors?.companyAddress2" variant="outlined"
                                                density="comfortable" label="Company Address 2" color="primary"
                                                clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-select v-model="form.businessType" :error-messages="errors?.businessType"
                                                density="comfortable" variant="outlined" label="Business Type"
                                                :items="['Motor Dealer', 'Motor Trader', 'Independent Dealer', 'Other']"
                                                color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.companyReg" :error-messages="errors?.companyReg"
                                                variant="outlined" density="comfortable" label="Company Reg. Number"
                                                color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.townCity" :error-messages="errors?.townCity"
                                                variant="outlined" density="comfortable" label="Town / City"
                                                color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.website" :error-messages="errors?.website"
                                                variant="outlined" density="comfortable" label="Website (Optional)"
                                                color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.country" :error-messages="errors?.country"
                                                variant="outlined" density="comfortable" label="Country" color="primary"
                                                clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.businessEmail"
                                                :error-messages="errors?.businessEmail" variant="outlined"
                                                density="comfortable" label="Business Email (optional)" color="primary"
                                                clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field variant="outlined" density="comfortable"
                                                label="Postal Code / Zip Code" v-model="form.postcode"
                                                :error-messages="errors?.postcode" color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-select density="comfortable" variant="outlined"
                                                v-model="form.motorTradeInsurance"
                                                :error-messages="errors?.motorTradeInsurance"
                                                label="Motor Trade Insurance" :items="['Yes', 'No', 'Pending']"
                                                color="primary" clearable="" />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field label="Cell" variant="outlined" v-model="form.telephone"
                                                :error-messages="errors?.telephone" density="comfortable"
                                                color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field variant="outlined" v-model="form.vatNumber"
                                                :error-messages="errors?.vatNumber" density="comfortable"
                                                label="VAT Number (optional)" color="primary" clearable />
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div v-else-if="step === 2" class="pa-7">
                            <div flat>
                                <h2 class="text-lg-h4 text-md-h4 text-h5 font-weight-bold mb-n2">User Information</h2>
                                <p class="text-body-2 mt-3">
                                    Add your personal details and profile image.
                                </p>
                                <v-container fluid class="py-6 px-0">
                                    <v-row class="gap-4" justify="start">
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.firstName" :error-messages="errors?.firstName"
                                                variant="outlined" density="comfortable" label="First Name"
                                                color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="form.surname" :error-messages="errors?.surname"
                                                variant="outlined" density="comfortable" label="Surname" color="primary"
                                                clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-select v-model="form.source" :error-messages="errors?.source"
                                                density="comfortable" variant="outlined" label="Referral Source?"
                                                :items="source" color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field variant="outlined" v-model="form.phone"
                                                :error-messages="errors?.phone" density="comfortable"
                                                label="Phone Number" color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field variant="outlined" density="comfortable" label="Position"
                                                color="primary" :error-messages="errors?.jobTitle"
                                                v-model="form.jobTitle" clearable />
                                        </v-col>
                                    </v-row>
                                    <v-row style="width: 800px;">
                                        <v-col cols="12" sm="6" md="4">

                                            <div class=" text-caption "><span class="text-body-1">Upload your ID</span>
                                            </div>
                                            <div class=" pt-3  ">
                                                <!-- Custom Button -->
                                                <v-icon class="pr-4 text-white">mdi-upload</v-icon>
                                                <v-btn color="" class="buttonBorder text-capitalize" variant="outlined"
                                                    style="height: 50px; border: 1px dashed rgb(var(--v-theme-border));"
                                                    @click="$refs.avatarInput.click()">
                                                    <span class="text-body-1">Upload</span>
                                                </v-btn>

                                                <!-- Helper / Error text -->
                                                <p v-if="errors?.avatar" class="pt-2 text-error text-body-2">
                                                    {{ errors.avatar }}
                                                </p>


                                                <!-- Hidden File Input -->
                                                <v-file-input ref="avatarInput" v-model="form.avatar" class="d-none"
                                                    accept="image/*" @change="onFileChange" />
                                            </div>
                                            <div class="mt-4 text-light text-body-2">
                                                <p>Accepted formats: JPG, PNG, PDF.</p>
                                            </div>

                                        </v-col>
                                    </v-row>
                                </v-container>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div v-else-if="step === 3" class="pa-7">
                            <div flat>
                                <h2 class="text-lg-h4 text-md-h4 text-h5 font-weight-bold mb-n2">Proof Documents</h2>
                                <p class="text-body-2 mt-3">
                                    Upload required proof documents.
                                </p>
                                <v-container fluid class="py-6 px-0">
                                    <v-row class="gap-4 mt-6" justify="start">
                                        <v-col cols="12" sm="6">
                                            <div class="text-body-1 text-caption">
                                                <span class="text-body-1">Proof of motor trade</span>
                                            </div>

                                            <div class="pt-3">
                                                <v-icon class="pr-4 text-white">mdi-upload</v-icon>

                                                <v-btn class="buttonBorder text-capitalize" variant="outlined"
                                                    style="height: 50px; border: 1px dashed rgb(var(--v-theme-border));"
                                                    @click="$refs.motorTradeProofRef.click()">
                                                    <span class="text-body-1">Upload</span>
                                                </v-btn>

                                                <p v-if="errors?.motorTradeProof" class="pt-2 text-error text-body-2">
                                                    {{ errors.motorTradeProof }}
                                                </p>

                                                <v-file-input ref="motorTradeProofRef" class="d-none"
                                                    v-model="form.motorTradeProof" accept="image/*"
                                                    @change="onFileChange('motorTradeProof', $event)" />
                                            </div>

                                            <div class="mt-4 text-light text-body-2">
                                                <p>Accepted formats: JPG, PNG, PDF.</p>
                                            </div>
                                        </v-col>


                                        <v-col cols="12" sm="6">
                                            <div class="text-body-1 text-caption">
                                                <span class="text-body-1"> Proof of address</span>
                                            </div>

                                            <div class="pt-3">
                                                <v-icon class="pr-4 text-white">mdi-upload</v-icon>

                                                <v-btn class="buttonBorder text-capitalize" variant="outlined"
                                                    style="height: 50px; border: 1px dashed rgb(var(--v-theme-border));"
                                                    @click="$refs.addressProofRef.click()">
                                                    <span class="text-body-1">Upload</span>
                                                </v-btn>

                                                <p v-if="errors?.addressProof" class="pt-2 text-error text-body-2">
                                                    {{ errors.addressProof }}
                                                </p>

                                                <v-file-input ref="addressProofRef" class="d-none"
                                                    v-model="form.addressProof" accept="image/*"
                                                    @change="onFileChange('addressProof', $event)" />
                                            </div>

                                            <div class="mt-4 text-light text-body-2">
                                                <p>Accepted formats: JPG, PNG, PDF.</p>
                                            </div>
                                        </v-col>


                                    </v-row>
                                </v-container>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div v-else="step === 4" class="pa-7">
                            <div flat>
                                <h2 class="text-lg-h4 text-md-h4 text-h5 font-weight-bold mb-n2">Login Details</h2>
                                <p class="text-body-2 mt-3">
                                    Set your login email & password.
                                </p>
                                <v-container fluid class="py-6 px-0">
                                    <v-row class="gap-4" justify="start">
                                        <v-col cols="12" sm="6">
                                            <v-text-field v-model="form.personalEmail"
                                                :error-messages="errors?.personalEmail" variant="outlined"
                                                density="comfortable" label="Login Email" color="primary" clearable />
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <v-text-field v-model="form.password" :error-messages="errors?.password"
                                                variant="outlined" density="comfortable" label="Password"
                                                color="primary" clearable />
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </div>
                        </div>
                        <v-divider></v-divider>

                        <!-- Footer Actions with Login Message -->

                        <v-row class="w-100 px-4 pt-6 pb-4" no-gutters>
                            <v-col cols="12" class="d-flex flex-column flex-md-row align-center justify-space-between">
                                <!-- Buttons: appear first on small screens -->
                                <div class="d-flex justify-center justify-md-end ga-3 order-1 order-md-2 mb-3 mb-md-0">
                                    <v-btn variant="tonal" color="primary" :disabled="step === 1" @click="step--">
                                        Previous
                                    </v-btn>
                                    <v-btn color="primary" @click="handleNext">
                                        {{ step === 4 ? 'Submit' : 'Next' }}
                                    </v-btn>
                                </div>

                                <!-- Login message: appear below on small screens -->
                                <div class="d-flex flex-column align-center align-md-start order-2 order-md-1">
                                    <span class="text-light_text_on text-body-1 text-center text-md-left">
                                        Already have an account? <router-link to="/login"
                                        class="text-primary px-1 text-body-2 text-center text-md-left">
                                        Login
                                    </router-link>
                                    </span>
                                   
                                </div>
                            </v-col>
                        </v-row>


                    </v-col>
                </v-row>
            </v-container>
        </v-main>

        <!-- Optional Snackbar for Submit -->
        <v-snackbar v-model="showMessage" color="success" timeout="2500">
            Form submitted successfully!
        </v-snackbar>
    </v-app>
</template>
<script>
import { useThemeStore } from '@/stores/themeStore';
import AuthHeader from './AuthHeader.vue';
import { useUserStore } from '@/stores/userStore';
import { useAlertStore } from '@/stores/alertStore';


export default {
    name: "StepperForm",
    components: { AuthHeader },
    data() {
        return {
            themeStore: useThemeStore(),
            userStore: useUserStore(),
            alertStore: useAlertStore(),

            form: {
                companyName: '',
                companyAddress1: '',
                companyAddress2: '',
                businessType: null,
                companyReg: '',
                townCity: '',
                website: '',
                country: '',
                businessEmail: '',
                postcode: '',
                motorTradeInsurance: null,
                telephone: '',
                vatNumber: '',
                firstName: '',
                surname: '',
                source: null,
                phone: '',
                jobTitle: '',
                avatar: null,

                motorTradeProof: null,
                addressProof: null,

                personalEmail: '',
                password: '',

            },
            errors: {

            },
            source: [
                'Google Search',
                'Social Media',
                'Online Advertisement',
                'Friend / Colleague',
                'Dealership Partner',
                'Trade Event or Expo',
                'Vehicle Trader Forum',
                'Other'
            ],
            step: 1,
            steps: [
                {
                    label: 'Company',
                    subHeading: "Business details",
                },
                {
                    label: 'User',
                    subHeading: "Personal Info",
                },
                {
                    label: 'Proofs',
                    subHeading: "Docs",
                },
                {
                    label: 'Login Details',
                    subHeading: "Email & password",
                },
            ],
            proofMotorTrade: [],
            proofAddress: [],
            showMessage: false,
        };
    },
    mounted() {

        this.$themeStore.startLoading()
        this.userStore.getProfile().then(() => {
            this.$themeStore.endLoading()
            this.$router.replace("/user/dashboard");
        }).catch(() => this.$themeStore.endLoading())

    },
    methods: {
        handleNext() {
            if (this.step === 4) {
                this.onSubmit()
            } else {
                this.step++
            }
        },
        // handleNext(next) {
        //     switch (this.step) {
        //         case 1:
        //             this.step1(next);
        //             break;
        //         case 2:
        //             this.step2(next);
        //             break;
        //         case 3:
        //             this.step3(next);
        //             break;
        //         case 4:
        //             this.step4(next);
        //             break;
        //         default:

        //             break;
        //     }
        // },
        step1(next) {

            next()
        },
        step2(next) {
            next()
        },
        step3(next) {
            next()
        },
        step4(next) {
            this.onSubmit();
        },
        async onSubmit() {

            this.themeStore.startLoading()
            this.errors = {};

            try {

                console.log(this.form);

                let response = await this.userStore.registerRequest(this.form);
                this.userStore.initializeUserSession(response.token, response.user);
                this.themeStore.endLoading();
                this.alertStore.add('Account Created Successfully', 'success');

            } catch (error) {

                this.themeStore.endLoading();
                this.errors = error.validation || {};
                this.alertStore.add(error.message, 'error');

            }


        }

    },
};
</script>

<style scoped>
.step.active .circle {
    background: rgb(var(--v-theme-primary));
    color: white;

}

.step.done .circle {
    background: rgb(var(--v-theme-primary));
    color: white;

}

@media (max-width:720px) {
    .stepper {
        max-width: 380px !important;
    }

    .progress {
        max-width: 380px !important;
    }
}
</style>
