<template>
    <div class="d-flex flex-lg-row flex-md-row flex-column ga-5 w-100  ">
        <div class="w-lg-50 w-100">
            <v-card title="Current Plan" class="bg-surface" border="">
                <div class="border"></div>
                            <div class="w-75  pl-5 py-4 ">
                                <p class="d-flex justify-space-between">
                                    <span class="text-body-1">Days</span>
                                    <span class="text-body-1">{{ usedDays }} of 30 Days</span>
                                </p>
                                <div class="py-3" style="width:auto">
                                    <v-progress-linear height="7" color="primary"
                                        :model-value="progressPercentage"></v-progress-linear>
                                </div>
                                <p class="text-body-2" style="color:rgb(var(--v-theme-light))">{{ remainingDays }} days
                                    remaining until your plan
                                    requires update</p>
                            </div>
                            <v-divider></v-divider>

                            <div class="py-4 pl-5  ">
                                <div class="mb-3 ">
                                    <p class="text-body-1 mb-2">Your Current Plan is
                                        <span class="activeUnit pa-lg-2 pa-md-2 pa-1 d-inline "> "{{
                                            userStore.user?.plan?.plan?.plan_name }}" </span>
                                    </p>
                                    <p class="text-body-2 " style="color:rgb(var(--v-theme-light))">For small dealers.
                                    </p>
                                </div>
                                <div class="mt-8">
                                    <p class="text-body-1">Active until <span
                                            class="activeUnit pa-2 d-lg-inline d-md-inline d-block">{{
                                                userStore.user?.plan?.membership_expiry_date }}</span> </p>
                                    <p class="text-body-2 font-weight-thin mt-2"
                                        style="color:rgb(var(--v-theme-light))">We
                                        will send you a notification upon Subscription expiration</p>
                                </div>
                            </div>

                            <div class="mt-4 pl-5">
                                <v-btn @click="showDialog = true" color="primary" variant="flat" class="buttonBorder" :to="'/checkout'"
                                    style="height: 50px; ">
                                    <span class="text-capitalize text-body-1">Upgrade Plain</span></v-btn>

                            </div>

                            <v-container class="d-flex m-2">
                                <v-dialog v-model="showDialog" max-width="">
                                    <template v-slot:default="{ isActive }">
                                        <v-btn icon="mdi-close" variant="flat" @click="isActive.value = false"
                                            style="position: absolute; z-index: 1; right: 0;"></v-btn>
                                        <PricePlan />
                                    </template>
                                </v-dialog>
                            </v-container>
                    
        
            </v-card>
        </div>
        <div class="w-lg-50 w-100">
            <v-card title="Current Plan" class="bg-surface" border="">
                <div class="border"></div>

                <v-card-text class="d-flex align-center justify-center" style="min-height: 360px;">
                    <PaymentForm />
                </v-card-text>

            </v-card>

        </div>
    </div>
</template>
<script>

import { useUserStore } from '@/stores/userStore';
import { usePageStore } from '@/stores/pageStore';
import PaymentForm from './PaymentForm.vue';
import PricePlan from './pricePlan.vue';

export default {
    components: {
        PaymentForm,
        PricePlan
    },
    data() {
        return {
            userStore: useUserStore(),
            pageStore: usePageStore(),
            // showDialog: true,
            totalDays: 30,
        };
    },
    computed: {
        remainingDays() {

            const today = new Date();

            const expiry = new Date(this.userStore.user.plan?.membership_expiry_date);

            // const expiry = new Date(this.userStore.user.plans.membership_expiry_date);


            const diffTime = expiry - today;
            return diffTime > 0 ? Math.ceil(diffTime / (1000 * 60 * 60 * 24)) : 0;
        },
        usedDays() {
            return this.totalDays - this.remainingDays;
        },
        progressPercentage() {
            return (this.usedDays / this.totalDays) * 100;
        }
    },
    mounted() {


    },
    methods: {
        loadDataFromProfile() {

        }
    }
};
</script>


<style scoped>
.buttonBorder {
    border-radius: 2px;
}

.activeUnit {
    /* background-color: rgb(var(--v-theme-primaryLite)); */
    background-color: #3399ff20;
    border-radius: 2px;
}
</style>