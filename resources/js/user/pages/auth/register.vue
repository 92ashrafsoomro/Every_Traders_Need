<template>
    <v-app>
        <div class="position-absolute bottom-0 left-0 right-0 h-50 bg-primary"
            style="z-index: 0; clip-path: polygon(0 29%, 100% 0, 100% 100%, 0% 100%);">
        </div>
        <AuthHeader />

        <v-main style="z-index: 10;" class="z-index-1 h-lg-screen d-flex align-center justify-center">
            <v-container fluid class="d-flex justify-center align-center">
                <v-row justify="center">
                    <v-col cols="12" sm="10" md="8" lg="6" xl="5">
                        <v-stepper class="pa-4" v-model="step"
                            :items="['Company Info', 'User Info', 'Proof', 'Security']">

                            <!-- Step 1 -->
                            <template v-slot:item.1>
                                <v-card flat>
                                    <v-card-title class="text-h4 font-weight-bold mb-n2">Company
                                        Information</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis">
                                        Provide your company details.
                                    </v-card-subtitle>
                                    <v-container fluid class="py-6">
                                        <v-row class="gap-4" justify="start">
                                            <v-col v-for="n in 13" :key="n" cols="12" sm="6" md="4">
                                                <v-text-field variant="outlined" density="comfortable"
                                                    label="Select Option" color="primary" clearable />
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card>
                            </template>

                            <!-- Step 2 -->
                            <template v-slot:item.2>
                                <v-card flat>
                                    <v-card-title class="text-h4 font-weight-bold mb-n2">User Information</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis">
                                        Add your personal details and profile image.
                                    </v-card-subtitle>
                                    <v-container fluid class="py-6">
                                        <v-row class="gap-4" justify="start">
                                            <v-col v-for="n in 5" :key="n" cols="12" sm="6" md="4">
                                                <v-text-field variant="outlined" density="comfortable"
                                                    label="Select Option" color="primary" clearable />
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card>
                            </template>

                            <!-- Step 3 -->
                            <template v-slot:item.3>
                                <v-card flat>
                                    <v-card-title class="text-h4 font-weight-bold mb-n2">Proof Documents</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis">
                                        Upload required proof documents.
                                    </v-card-subtitle>
                                    <v-row class="gap-4 mt-6" justify="start">
                                        <v-col cols="12" sm="6">
                                            <div class="text-medium-emphasis text-caption mb-2">Proof of motor trade
                                            </div>
                                            <v-file-input color="primary" v-model="proofMotorTrade"
                                                label="Upload Documents" multiple show-size variant="outlined"
                                                density="comfortable" accept=".pdf,.docx,.xlsx"
                                                prepend-icon="mdi-file-upload" />
                                        </v-col>
                                        <v-col cols="12" sm="6">
                                            <div class="text-medium-emphasis text-caption mb-2">Proof of address</div>
                                            <v-file-input color="primary" v-model="proofAddress"
                                                label="Upload Documents" multiple show-size variant="outlined"
                                                density="comfortable" accept=".pdf,.docx,.xlsx"
                                                prepend-icon="mdi-file-upload" />
                                        </v-col>
                                    </v-row>
                                </v-card>
                            </template>

                            <!-- Step 4 -->
                            <template v-slot:item.4>
                                <v-card flat>
                                    <v-card-title class="text-h4 font-weight-bold mb-n2">Security</v-card-title>
                                    <v-card-subtitle class="text-medium-emphasis">
                                        Set your login email & password.
                                    </v-card-subtitle>
                                    <v-container fluid class="py-6">
                                        <v-row class="gap-4" justify="start">
                                            <v-col v-for="n in 2" :key="n" cols="12" sm="6">
                                                <v-text-field variant="outlined" density="comfortable"
                                                    label="Select Option" color="primary" clearable />
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card>
                            </template>

                            <!-- Footer Actions with Login Message -->
                            <template v-slot:actions="{ next, prev }">
                                <v-row class="w-100 align-center px-4 py-2 border-t" no-gutters>
                                    <!-- Login message only on last step -->
                                    <v-col cols="12" sm="4"
                                        class="d-flex align-center justify-center justify-sm-start mb-2 mb-sm-0">
                                        <div class="text-medium-emphasis text-center text-sm-left">
                                            Already have an account?
                                            <v-btn to="/login" variant="plain" class="px-1 text-body-2" color="primary"
                                                size="small">
                                                Login
                                            </v-btn>
                                        </div>
                                    </v-col>

                                    <!-- Previous & Next/Submit Buttons -->
                                    <v-col cols="12" sm="8" class="d-flex justify-center justify-sm-end">
                                        <v-btn class="mr-2" variant="tonal" color="primary" :disabled="step === 1"
                                            @click="prev">
                                            <v-icon start>mdi-arrow-left</v-icon>
                                            Previous
                                        </v-btn>

                                        <v-btn variant="flat" color="primary" @click="handleNext(next)">
                                            {{ step === 4 ? 'Submit' : 'Next' }}
                                            <v-icon end>{{ step === 4 ? 'mdi-check' : 'mdi-arrow-right' }}</v-icon>
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </template>

                        </v-stepper>
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
import AuthHeader from './AuthHeader.vue';

export default {
    name: "StepperForm",
    components: { AuthHeader },
    data() {
        return {
            step: 1,
            proofMotorTrade: [],
            proofAddress: [],
            showMessage: false,
        };
    },
    methods: {
        handleNext(next) {
            if (this.step === 4) {
                console.log("Form submitted!");
                this.showMessage = true;
            } else {
                next();
            }
        },
    },
};
</script>

