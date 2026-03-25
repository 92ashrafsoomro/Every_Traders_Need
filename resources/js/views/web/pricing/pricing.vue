<template>
    <div class="d-flex  text-center items-center justify-center mt-12 mb-12">
        <h1 class="text-h2 font-weight-bold">Pricing</h1>
    </div>
    <div class="d-flex justify-center mb-8 px-4 ">
        <v-btn-toggle v-model="billingType" mandatory rounded color="primary" class="border pa-1">
            <v-btn value="month" class="text-capitalize"><span class="text-body-2 text-primary mr-1">-10% </span>
                Monthly</v-btn>
            <v-btn value="Quaterly" class="text-capitalize"><span class="text-body-2 text-primary mr-1">-10% </span>
                Quaterly</v-btn>
            <v-btn value="year" class="text-capitalize"><span class="text-body-2 text-primary mr-1">-10% </span>
                Yearly</v-btn>
        </v-btn-toggle>
    </div>
    <v-container style="max-width: 1400px ; margin: 100px ;" class="mx-auto my-10 d-flex">

        <v-row justify="center" align="start" dense>
            <!-- user Active plan -->
            <!-- plans -->
            <v-col v-for="item in filteredPlans" :key="item.id" cols="12" sm="6" md="3"
                style=" width: 300px !important; position: relative;">

                <!-- Popular -->
                <div class="  d-flex w-100 left-0  
                        justify-center items-center " style=" position: absolute; z-index: 10; left: 0;">
                    <v-chip v-if="item.plan_name === 'Trader Pro'" color="primary" variant="flat"
                        class="mb-4 d-flex justify-center  items-center px-2" xsmall>
                        <span class="">Most Popular</span>
                    </v-chip>
                </div>
                <v-card v-if="item.plan_name === 'Trader Pro'" class="ma-3 bg-background"
                    :class="{ 'active-border': userStore.user?.plan?.plan_id === item.id }" :style="[
                        { 'border-radius': '30px', 'min-height': '700px' },
                        userStore.user?.plan?.plan_id === item.id
                            ? { 'border': '2px solid rgb(var(--v-theme-border)) !important' }
                            : { 'border': '2px solid rgb(var(--v-theme-primary)) !important' }
                    ]">


                    
                    <div class="rounded-lg   bg-surface pa-4 shadow-lg" style="
                            border-radius: 20px !important ; ">

                        <div class="bg-background pa-4 rounded-xl" style=" height: 175px">
                            <div class="d-flex justify-end  ">
                                <v-chip color="primary" class="mb-4 d-flex justify-end px-2" small>
                                    {{ item.discount || 0 }} % off
                                </v-chip>
                            </div>
                            <div class="">

                                <h3 class="text-body-1 font-weight-bold text-whiteLite ">{{ item.plan_name }} </h3>
                                <p class="text-body-subtitle mt-2 text-light_text_on"
                                    style="text-decoration: line-through;">{{userStore.currencySymbol}}{{ item.price }}</p>
                                <h3 class="text-h5 font-weight-bold text-whiteLite d-inline-block pt-2"> {{userStore.currencySymbol}}{{
                                    discountPrice(item) }} </h3>
                                <span class="text-body-1 ml-0  text-light_text_on">/{{ durationLabel(item) }}</span>
                            </div>

                        </div>
                        <div class="py-2 px-1">
                            <p style="color:rgb(var(--v-theme-light));" class="py-4">{{ item.short_desc }}</p>
                            <v-btn v-if="userStore.user?.plan?.plan_id === item.id" color="white" variant="outlined"
                                size="large" class="text-capitalize disabled-btn w-100" disabled>
                                Your Current Plan
                            </v-btn>

                            <v-btn v-else color="primary" size="large" :to="'/checkout'" class="text-capitalize w-100"
                                @click="selectPlan(item)">
                                Upgrade Plan
                            </v-btn>
                        </div>


                    </div>

                    <div class="pa-4 " style="height: 200px;">
                        <div class="d-flex align-start mb-3  ">
                            <ul style="list-style: none;">
                                <li v-for="desc in (item.description)" :key="desc.id" class="mb-4 d-flex">
                                    <v-icon style="color: rgb(var(--v-theme-primary));" class="mr-3">
                                        mdi-check-decagram
                                    </v-icon>

                                    <div class="d-flex items-center text-body-2 text-light_text_on">
                                        {{ desc }}
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </v-card>

                <!-- Plans -->

                <v-card v-else class="ma-3 bg-background border"
                    :class="{ 'active-border': userStore.user?.plan?.plan_id === item.id }" :style="[
                        { 'border-radius': '30px', 'min-height': '700px' },
                            userStore.user?.plan?.plan_id === item.id
                            ? { 'border': '2px solid rgb(var(--v-theme-border)) !important' }
                            : { 'border': '1px solid rgb(var(--v-theme-border)) !important' }
                    ]">
                    <div class="rounded-lg  bg-surface pa-4 shadow-lg" style="
                            border-radius: 2px 2px 20px 20px !important ;">
                        <div class="bg-background pa-4 rounded-xl">
                            <div class="d-flex justify-end">
                                <v-chip color="primary" class="mb-4 d-flex justify-center px-2" small>
                                    {{ item.discount || 0 }} % off
                                </v-chip>
                            </div>
                            <div>

                                <h3 class="text-body-1 font-weight-bold text-whiteLite ">{{ item.plan_name }} </h3>
                                <p class="text-body-subtitle mt-2 text-light_text_on"
                                    style="text-decoration: line-through;">{{userStore.currencySymbol}}{{ item.price }}</p>
                                <h3 class="text-h5 font-weight-bold text-whiteLite d-inline-block pt-2"> {{userStore.currencySymbol}}{{
                                    discountPrice(item) }} </h3>
                                <span class="text-body-1 ml-0  text-light_text_on">/{{ durationLabel(item) }}</span>
                            </div>

                        </div>
                        <div class="py-2 px-1">
                            <p style="color:rgb(var(--v-theme-light));" class="py-4">{{ item.short_desc }}</p>
                            <v-btn v-if="userStore.user?.plan?.plan_id === item.id" color="primary" size="large"
                                class="text-capitalize w-100 disabled-btn" disabled>
                                Your Current Plan
                            </v-btn>

                            <v-btn v-else color="primary" size="large" :to="'/checkout'" class="text-capitalize w-100"
                                @click="selectPlan(item)">
                                Upgrade Plan
                            </v-btn>
                        </div>
                    </div>

                    <div class="pa-4 " style="height: 200px;">
                        <div class="d-flex align-start mb-3  ">
                            <ul style="list-style: none;">
                                <li v-for="desc in (item.description)" :key="desc.id" class="mb-4 d-flex">
                                    <v-icon style="color: rgb(var(--v-theme-primary));" class="mr-3">
                                        mdi-check-decagram
                                    </v-icon>

                                    <div class="d-flex items-center text-body-2 text-light_text_on">
                                        {{ desc }}
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </v-card>

            </v-col>
        </v-row>
    </v-container>

</template>


<script>
import General from '@/models/general.model';
import { useUserStore } from '@/stores/userStore';
// import pricingplain from './pricingplain.vue';
// import featureTable from './featureTable.vue';
export default {
    name: "pricingCard",

    data() {
        return {
            userStore: useUserStore(),
            data: [],
            billingType: 'month',
            loading: false,


        }
    },
    mounted() {
        this.getPlan()
    },
    methods: {
        async getPlan() {
            this.loading = false
            try {
                let res = await General.get("/api/cruds/packages")
                this.data = res.data.filter(plan => plan.status === 1);
                this.loading = true
            } catch (error) {
                console.error(error)
            } finally {
                this.loading = false
            }
        },
        durationLabel(item) {
            // quarterly case
            if (item.duration_unit === 'month' && item.duration_value === 3) {
                return 'Quarterly'
            }

            // baaki cases same
            return item.duration_unit
        },
        selectPlan(item) {
            this.userStore.setPlanId(item.id);
        },
        discountPrice(item) {
            if (!item.discount) return item.price

            return (
                item.price - (item.price * item.discount) / 100
            ).toFixed(2)
        },

    },
    computed: {
        filteredPlans() {
            return this.data
                .filter(plan => {
                    if (this.billingType === 'month') {
                        return plan.duration_unit === 'month' && plan.duration_value !== 3;
                    }
                    if (this.billingType === 'Quaterly') {
                        return plan.duration_value === 3 && plan.duration_unit === "month";
                    }
                    if (this.billingType === 'year') {
                        return plan.duration_unit === 'year';
                    }
                    return false;
                })
                .sort((a, b) => a.sort_by - b.sort_by);
        }
    }

}
</script>

<style scoped>
.active-border {
    border: 2px solid white !important;
}

.disabled-btn {
    pointer-events: auto !important;
    cursor: not-allowed !important;
    opacity: 0.6;
}

.trader-pro {
    border: 2px solid rgb(var(--v-theme-primary)) !important;
}

:deep(.v-btn--active) {
    background-color: rgb(var(--v-theme-primary), 0.2) !important;
}
</style>