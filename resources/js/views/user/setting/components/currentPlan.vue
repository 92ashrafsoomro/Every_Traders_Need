<template>
    <v-card title="Current Plan" class="bg-surface"  >
        <div class="border" ></div>
        <v-container>
            <div class="d-flex  w-100 flex-wrap justify-space-between">

                <div class="py-3 px-3 pr-7 w-50 border-e" >

                    <div class="w-100 mb-4">
                        <p class="d-flex justify-space-between">
                            <span class="text-body-1">Days</span>
                            <span class="text-body-1">{{ usedDays }} of 30 Days</span>
                        </p>
                        <div class="py-3" style="width:auto">
                            <v-progress-linear height="7" color="primary" :model-value="progressPercentage"></v-progress-linear>
                        </div>
                        <p class="text-body-2" style="color:rgb(var(--v-theme-light))">{{ remainingDays }} days remaining until your plan
                            requires update</p>
                    </div>

                    <div class="py-5 mb-4">
                        <div class="mb-3 ">
                            <p class="text-body-1">Your Current Plan is  <span class="activeUnit pa-2"> "{{ userStore.user?.plan?.plan?.plan_name }}" </span></p>
                            <p class="text-body-2" style="color:rgb(var(--v-theme-light))">For small dealers.</p>
                        </div>
                        <div class="mt-8">
                            <p class="text-body-1">Active until <span class="activeUnit pa-2">{{ userStore.user?.plan?.membership_expiry_date }}</span> </p>
                            <p class="text-body-2 font-weight-thin mt-2" style="color:rgb(var(--v-theme-light))">We will send you a notification upon Subscription expiration</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <v-btn 
                            @click="showDialog = true" 
                            color="primary"  
                            variant="flat"
                            class="buttonBorder"
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
                </div>
                <div class="w-50 ">
                <PaymentForm />
            </div></div>
        </v-container>
    </v-card>
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
            showDialog: false,
            totalDays:30,
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
    .buttonBorder{
    border-radius: 2px;
}
.activeUnit{
    /* background-color: rgb(var(--v-theme-primaryLite)); */
    background-color: #3399ff20;
    border-radius: 2px;
}

</style>