<template>
    <v-container fluid max-width="1300px"  class="bg-background pa-8" >
                <v-row  >
                    <v-col cols="12" >
                           <h1 class="text-h4 text-white mb-6 text-center">Checkout</h1>
                    </v-col>
                    <v-col cols="12" lg="7">
                        
                        <v-card class="pa-6" elevation="4">
                            <v-card-title class="text-h6 text-white mb-4">Billing Info</v-card-title>
                            <div class="border" ></div>

                            <v-card-text class="pa-0">
                                <div class="pt-5 pb-10" >
                                    <span style="padding-right: 13px;padding-bottom: 10px;border-bottom: 3px solid #0080ff;" class=" text-subtitle-1 text-white ">User Details</span>
                                </div>
                                

                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="form.firstName" label="First Name" variant="outlined"
                                            density="comfortable"  color="blue-lighten-1"
                                            readonly />
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="form.lastName" label="Last Name" variant="outlined"
                                            density="comfortable"  color="blue-lighten-1"
                                            readonly />
                                    </v-col>
                                </v-row>

                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="form.phone" label="Phone No" variant="outlined"
                                            density="comfortable" color="blue-lighten-1"
                                            prepend-inner-icon="mdi-flag" readonly>
                                            <template #prepend-inner>
                                                <v-img src="https://flagcdn.com/16x12/gb.png" width="20"
                                                    class="me-2"></v-img>
                                                <span class="text-white">+44</span>
                                            </template>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="form.country" label="Country" variant="outlined"
                                            density="comfortable"  color="blue-lighten-1"
                                            readonly />
                                    </v-col>
                                </v-row>

                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="form.province" label="Province / State"
                                            variant="outlined" density="comfortable" 
                                            color="blue-lighten-1" readonly />
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="form.city" label="City" variant="outlined"
                                            density="comfortable"  color="blue-lighten-1"
                                            readonly />
                                    </v-col>
                                </v-row>

                                <v-row>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="form.zipCode" label="Zip Code" variant="outlined"
                                            density="comfortable"  color="blue-lighten-1" />
                                    </v-col>
                                </v-row>

                                <v-text-field v-model="form.address" label="Address" variant="outlined"
                                    density="comfortable"  color="blue-lighten-1"
                                    class="mt-4" />

                                <v-btn color="primary" class="mt-8 text-white text-capitalize"
                                    @click="submit">
                                    Submit
                                </v-btn>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="12" lg="5">
                        <v-card class="pa-6 bg-surface" elevation="4" height="100%">
                            
                            <v-card-title class="text-h6 text-white mb-4">Order Summary</v-card-title>
                              <div class="border" ></div>

                            <div class="pt-5 mb-6">
                                <div class="d-flex justify-space-between align-center mb-3">
                                    <span class="text-white">Your Plan</span>
                                    <v-chip color="blue-lighten-1" label class="px-4">
                                        <v-icon start>mdi-check</v-icon>
                                        Free
                                    </v-chip>
                                </div>
                            </div>

                            <div>
                                <div class="text-caption text-grey-lighten-1">
                                    For small dealers.
                                </div>

                                <div class="text-h4 text-white font-weight-bold mt-2">
                                    £0.00
                                    <span class="text-caption text-grey-lighten-1">Per Month</span>
                                </div>

                                <v-select v-model="selectedPlan" :items="plans" item-title="text" item-value="value"
                                    label="Change Plan" variant="outlined" density="comfortable"
                                    bg-color="grey-darken-4" class="mt-6" />
                            </div>

                            <v-divider class="my-6"></v-divider>

                            <div class="text-white">
                                <div class="d-flex justify-space-between mb-2">
                                    <span>Base price</span>
                                    <span>£0.00</span>
                                </div>
                                <div class="d-flex justify-space-between mb-2">
                                    <span>Discount</span>
                                    <span>£0.00</span>
                                </div>
                                <div class="d-flex justify-space-between mb-4">
                                    <span>GST</span>
                                    <span>£0.00</span>
                                </div>

                                <v-divider></v-divider>

                                <div class="d-flex justify-space-between mt-4 text-h6">
                                    <strong>Total</strong>
                                    <strong>£0.00</strong>
                                </div>
                            </div>
                        </v-card>
                    </v-col>
                </v-row>
    
    </v-container>
</template>

<script>
export default {
    name: 'CheckoutPage',
    data() {
        return {
            form: {
                firstName: 'Owais',
                lastName: 'Azam',
                phone: '0312239342',
                country: 'Pakistan',
                province: 'Sindh',
                city: 'karachi',
                zipCode: '123',
                address: 'Address'
            },
            selectedPlan: 'free',
            plans: [
                { text: 'Free Plan', value: 'free' },
                { text: 'Pro Plan - £29/month', value: 'pro' },
                { text: 'Enterprise - Custom', value: 'enterprise' }
            ]
        }
    },
    methods: {
        submit() {
            // Handle form submission
            alert('Order submitted (Free plan - no payment required)')
        }
    }
}
</script>

<style scoped>
.text-h6,
.text-h4,
.text-white {
    font-family: 'Inter', sans-serif !important;
}
</style>