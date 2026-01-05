<template>
    <v-container fluid max-width="1400px" class="bg-background pa-8">
        <v-row class="mt-10 mb-10">
            <v-col cols="12 User Details">
                <h1 class="text-h4 text-whiteLiteLite font-weight-bold   ">Checkout</h1>
            </v-col>
            <v-col cols="12" lg="7">

                <v-card class="pa-lg-6 pa-md-4 pa-2 border-sm" :loading="loading">
                    <v-card-title class="text-h5 font-weight-bold text-whiteLiteLite mb-4">Billing Info</v-card-title>
                    <div class="border"></div>

                    <v-card-text class="pa-0">
                        <div class="pt-5- pb-10 mt-4">
                            <span style="padding-bottom: 10px;border-bottom: 3px solid #0080ff;"
                                class=" text-h6  text-whiteLite ">User Details</span>
                        </div>

                        <v-row class="pa-0">
                            <v-col cols="12" sm="6">
                                <v-text-field v-model="form.first_name" label="First Name" variant="outlined"
                                    density="comfortable" class="custom-field" />


                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field class="custom-field" v-model="form.last_name" label="Last Name"
                                    variant="outlined" density="comfortable" />
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field class="custom-field" v-model="form.phone" label="Phone" variant="outlined"
                                    density="comfortable" />
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field class="custom-field" v-model="form.email" label="Email" variant="outlined"
                                    density="comfortable" />
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field class="custom-field" v-model="form.country" label="Country"
                                    variant="outlined" density="comfortable" />
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field class="custom-field" v-model="form.state" label="State" variant="outlined"
                                    density="comfortable" />
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field class="custom-field" v-model="form.city" label="City" variant="outlined"
                                    density="comfortable" />
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field class="custom-field" v-model="form.zip_code" label="Zip Code"
                                    variant="outlined" density="comfortable" />
                            </v-col>
                            <v-col cols="12" sm="12">
                                <v-text-field class="custom-field" v-model="form.address" label="Address"
                                    variant="outlined" density="comfortable" />
                            </v-col>
                        </v-row>

                        <div>
                            <div class="pt-5 pb-8">
                                <span style="padding-right: 13px;padding-bottom: 10px;border-bottom: 3px solid #0080ff;"
                                    class=" text-h6 text-whiteLite ">Card Details</span>
                            </div>
                            <div>
                                <v-text-field class="custom-field" v-model="form.cardholderName" label="Name on card"
                                    variant="outlined" density="comfortable" />
                            </div>
                            <div class="bg-background mt-3" style="border: 1px solid rgb(var(--v-theme-border));">
                                <div id="card-element" class="my-4 mx-2"></div>
                                <div id="card-errors" class="text-red mx-2 text-caption"></div>
                            </div>
                            <v-checkbox class="mt-4 w-full ">
                                <template #label>
                                    <div
                                        class="flex flex-col text-body-2 items-start sm:items-center ">
                                        <span>I have read and agree to the</span>
                                        <router-link to="/terms-and-conditions" target="_blank"
                                            class="text-primary  ml-lg-2 ml-2 mr-lg-2 mr-2 underline">
                                            Terms & Conditions
                                        </router-link>
                                        <span class="ml-0 sm:ml-0 mr-0 sm:mr-2">,</span>
                                        <router-link to="/privacy-policy" target="_blank"
                                            class="text-primary ml-lg-2 ml-2 mr-lg-2 mr-2 underline">
                                            Privacy Policy
                                        </router-link>
                                        <span class="ml-0 sm:ml-0 mr-0 sm:mr-2">and</span>
                                        <router-link to="/disclaimer" target="_blank"
                                            class="text-primary ml-lg-2 ml-2 mr-lg-2 mr-2 underline">
                                            Disclaimer
                                        </router-link>
                                        <span class="ml-0 sm:ml-0">.</span>
                                    </div>
                                </template>
                            </v-checkbox>



                        </div>

                        <v-btn color="primary" class="mt-3 text-whiteLite text-capitalize" style="height: 50px;"
                            @click="submit">Submit</v-btn>
                    </v-card-text>
                </v-card>
            </v-col>

            <v-col cols="12" lg="5">
                <div style="position: sticky; top: 70px;">
                    <div class="d-flex  mb-4  justify-space-between pa-6 rounded-sm "
                        style="background-color: rgb(var(--v-theme-primary),0.2);">
                        <div class="d-flex align-center gap-2">
                            <v-icon class="bg-primary rounded-sm" size="30">
                                mdi-plus
                            </v-icon>

                            <div class="ml-4">
                                <div class="text-whiteLite font-weight-bold ">
                                    {{ oldPlan?.plan?.plan_name }}
                                </div>
                                <div class="text-body-2">

                                    Your active plan

                                </div>
                            </div>
                        </div>

                        <div class="text-whiteLite text-right">
                            <div class="text-body-1 font-weight-bold">{{ oldPlan?.plan?.price }}</div>
                            <div class="text-body-2">{{ oldPlan?.plan?.membership_expiry_date || 0 }}</div>
                        </div>
                    </div>


                    <v-card class="gradiantColor pa-6 bg-surface border-sm  mt-6" :loading="loading">

                        <v-card-title class="text-h5 font-weight-bold text-whiteLite mb-4 ">Order Summary</v-card-title>


                        <div>
                            <!-- Selected Plan Preview -->
                            <div v-for="item in planList" :key="item.id">
                                <div v-if="item.id === selectedPlan">
                                    <v-divider class="mb-4"></v-divider>
                                    <div class="d-flex   justify-space-between px-6 py-3 rounded-sm "
                                        style="background-color: rgb(var(--v-theme-primary));">
                                        <div class="d-flex align-center gap-2">
                                            <v-icon class="bg-white text-primary rounded-sm" size="25">
                                                mdi-plus
                                            </v-icon>
                                            <div class="ml-2">
                                                <div class="text-lg-h6  text-body-1 font-weight-bold">

                                                    {{ item.plan_name }}
                                                </div>
                                                <div class="text-body-2 d-lg-flex d-md-flex d-none">
                                                    {{ item.short_desc }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-lg-h6  text-body-1  text-whiteLite font-weight-bold ">
                                            £{{ item.price }}
                                            <div class="text-body-2 text-whiteLite ">
                                                Per {{ item.duration_unit }}
                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>

                            <!-- Custom Dropdown -->
                            <v-menu offset-y>

                                <template #activator="{ props }">
                                    <v-btn v-bind="props" block variant="outlined"
                                        class="mt-6 border bg-background text-capitalize pa-6 justify-space-between"
                                        append-icon="mdi-chevron-down">
                                        Change plan
                                    </v-btn>
                                </template>


                                <v-list class="v-list-rounded bg-background border-none mt-3 ml-lg-0 ml-md-0 ml-n5 " density="compact">
                                    <v-list-item v-for="item in planList" :key="item.id" @click="selectedPlan = item.id"
                                        class="pa-0 "
                                        :class="selectedPlan === item.id ? 'bg-primary text-whiteLite rounded-t' : 'bg-background'">
                                        <div
                                            class="d-flex justify-space-between  align-center w-100 pa-5 selectedHover">
                                            <div>
                                                <div class="text-body-1 font-weight-bold">
                                                    {{ item.plan_name }}
                                                </div>
                                                <div class="text-body-2"
                                                    :class="selectedPlan === item.id ? 'text-whiteLite' : 'text-whiteLite'">
                                                    {{ item.short_desc }}
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <div class="text-body-1 font-weight-bold ">
                                                    £{{ item.price }}
                                                </div>
                                                <div class="text-caption "
                                                    :class="selectedPlan === item.id ? 'text-whiteLite' : ''">
                                                    Per {{ item.duration_unit }}
                                                </div>
                                            </div>
                                        </div>

                                        <v-divider />
                                    </v-list-item>
                                </v-list>


                            </v-menu>
                        </div>




                        <div class="text-whiteLite mt-7">
                            <div class="d-flex justify-space-between mb-2">
                                <span>Base price</span>
                                <span>£{{ currentPlan?.price }}</span>
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
                            <div class="d-flex justify-space-between mb-2 mt-4">
                                <span>Total</span>
                                <span>£{{ currentPlan?.price }}</span>
                            </div>

                        </div>
                    </v-card>
                </div>
            </v-col>
        </v-row>

    </v-container>
</template>

<script>
import api from '@/plugins/axios';
import { useUserStore } from '@/stores/userStore';
import { loadStripe } from "@stripe/stripe-js";




export default {
    name: 'CheckoutPage',
    data() {
        return {
            userStore: useUserStore(),
            stripe: null,
            cardElement: null,
            processing: false,
            loading: false,
            form: {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                country: '',
                state: '',
                city: '',
                zip_code: '',
                address: '',

                payment_method_id: '',
                plan_id: null,
                cardholderName: '',
            },
            selectedPlan: null,
            planList: [],

        }
    },
    async mounted() {

        this.getPlans();
        this.getAuth();
        this.stripeLoad();

    },
    computed: {
        oldPlan() {
            return this.userStore.user?.plan;
        },
        currentPlan() {
            return this.planList.find((item) => item.id == this.selectedPlan)
        }
    },
    methods: {
        async stripeLoad() {

            this.stripe = await loadStripe("pk_test_TYooMQauvdEDq54NiTphI7jx");
            const elements = this.stripe.elements();
            this.cardElement = elements.create('card', {
                style: {
                    base: {
                        color: '#fff',
                        fontSize: '16px',
                        '::placeholder': { color: '#aab7c4' },
                    }
                }
            });
            this.cardElement.mount('#card-element');

        },
        getPlans() {
            try {
                api.get('/api/user/page/plansList').then((res) => {
                    this.planList = res.data.data;

                }).catch((error) => {
                    alert()
                });

            } catch (error) {
                alert('Something Went Wrong Contact To Admin.');
            }
        },
        getAuth() {

            this.form.first_name = this.userStore.user?.firstName;
            this.form.last_name = this.userStore.user?.firstName;
            this.form.phone = this.userStore.user?.phone;
            this.form.email = this.userStore.user?.personalEmail;
            this.form.country = this.userStore.user?.country;
            this.form.state = this.userStore.user?.townCity;
            this.form.city = this.userStore.user?.townCity;
            this.form.zip_code = this.userStore.user?.postcode;
            this.form.address = this.userStore.user?.companyAddress1;
            this.form.cardholderName = this.userStore.user?.firstName;

        },
        async submit() {
            console.log(this.selectedPlan);
            this.loading = true;

            try {


                if (!this.selectedPlan) {
                    this.$alertStore.add("Please Select Plan", "error");
                    return false;
                }

                if (!this.form.cardholderName) {
                    this.$alertStore.add("Please Add Cardholder Name", "error");
                    return false;
                }

                this.processing = true;

                const { paymentMethod, error } = await this.stripe.createPaymentMethod({
                    type: 'card',
                    card: this.cardElement,
                    billing_details: { name: this.form.cardholderName },
                });

                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                    this.processing = false;
                    return;
                }

                this.form.payment_method_id = paymentMethod.id;
                this.form.plan_id = this.selectedPlan;
                const res = await api.post('/api/stripe/createPaymentIntent', this.form);
                this.$alertStore.add("Payment Success", "success");
                this.$router.replace('/user/settings/billing')
                this.processing = false;

                this.loading = false;
                this.getAuth();

            } catch (error) {

                this.loading = false;

                this.$alertStore.add(error.message, "error")

            }

        }


    },

}
</script>

<style scoped>
.text-h6,
.text-h4,
.text-whiteLite {
    font-family: 'Inter', sans-serif !important;
}

.plan-dropdown {


    background-color: rgb(var(--v-theme-background));
}

.plan-item {

    cursor: pointer;
}

.selectedHover:hover {
    background-color: rgb(var(--v-theme-primary));
}

.v-list-rounded {
    /* background-color: aquamarine !important; */
    border-radius: 10px;
}

.gradiantColor {
    background: linear-gradient(to top, rgb(var(--v-theme-primary), 0.2) 5%, transparent 50%);
}
:deep(.v-overlay__content){
    border: none;
    
}
</style>