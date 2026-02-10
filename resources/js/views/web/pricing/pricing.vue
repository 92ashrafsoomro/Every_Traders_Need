<template>
    <v-container style="max-width: 1400px ;" class="mx-auto ">
        <div class="d-flex  text-center items-center justify-center">
            <h1 class="text-h2 font-weight-bold">Pricing</h1>
        </div>
        <v-row justify="center" class="gap-5 mt-20">
            <v-col v-for="item in data" :key="item.id" cols="12" sm="6" md="4">
                <v-card class="border rounded-lg ma-3">
                    <div class="rounded-lg  pa-2 shadow-lg" style="background-color: rgb(var(--v-theme-primary),0.2);
        border-radius: 2px 2px 20px 20px !important ;  box-shadow: 0 10px 20px -4px rgba(var(--v-theme-primary),0.8);">
                        <div class="bg-background px-2 py-4 rounded-xl">
                            <div>
                                <v-chip color="primary" class="mb-4 d-flex justify-center w-25" small>
                                    {{ item.discount || 0 }} % off
                                </v-chip>
                            </div>
                            <div>

                                <h3 class="text-h5 font-weight-bold text-white  pt-6">${{ item.plan_name }} </h3>
                                <h3 class="text-h5 font-weight-bold text-white  pt-2"> <span
                                        style="text-decoration: line-through;">${{ item.price }}</span>
                                    <span class="text-h4 font-weight-bold text-white mb-2">${{ discountPrice(item) }}
                                        <span class="text-body-1">/{{ item.duration_unit }}</span>
                                    </span>
                                </h3>


                            </div>

                        </div>
                        <div class="py-2 px-1">
                            <p style="color:rgb(var(--v-theme-light));" class="pb-2">{{ item.short_desc }}</p>
                            <v-btn color="primary" size="large" :to="'/checkout'" class="text-capitalize  w-100">Select
                                Plan</v-btn>
                        </div>
                    </div>

                    <div class="pa-4">
                        <div class="d-flex align-start mb-3  ">
                            <ul v-for="plan in PricePlanDes" :key="plan.plan_name" style="list-style: none; ">
                                <li v-for="desc in plan.plan_Description" :key="desc.id">
                                    <v-icon size="13">mdi-circle</v-icon>
                                    {{ desc.label }}
                                </li>
                            </ul>
                        </div>
                    </div>

                </v-card>
            </v-col>
        </v-row>
    </v-container>
    <!-- <div>
        <main style="max-width: 1400px;  " class="mx-auto h-100 py-10">
            <div class="d-flex  text-center items-center justify-center py-16">
                <h1 class="text-h2 font-weight-bold">Pricing</h1>
            </div>
            <v-row class="d-flex flex-column flex-lg-row flex-md-row pa-4" no-gutters="">
                <v-col>
                    <div class="d-flex flex-column justify-center text-body-2  h-100 w-lg-75 w-md-75 w-100">
                        <p>Hi there!</p>
                        <p>Buying stock at auction is fast, competitive, and risky.
                        </p>
                        <p>Autoboli was built to reduce that risk by giving you clear vehicle intelligence, valuations,
                            and reauction signals — all in one place.
                            You can explore Autoboli with limited access, but upgrading unlocks the tools that help you:
                        </p>
                        <ul class="ml-4 my-6" style="list-style: none;">
                            <li class="d-flex align-center text-lg-body-1 text-body-2  "><v-icon color="" class="mr-2  "
                                    style="width: 30px; height: 30px; background-color: rgb(var(--v-theme-primary),0.3); border-radius: 20px ;">mdi-check</v-icon>
                                Avoid bad stock</li>
                            <li class="d-flex align-center text-lg-body-1 text-body-2  mt-2"><v-icon color="" class="mr-2  "
                                    style="width: 30px; height: 30px; background-color: rgb(var(--v-theme-primary),0.3); border-radius: 20px ;">mdi-check</v-icon>
                                Save hours each week</li>
                            <li class="d-flex align-center text-lg-body-1 text-body-2  mt-2"><v-icon color="" class="mr-2  "
                                    style="width: 30px; height: 30px; background-color: rgb(var(--v-theme-primary),0.3); border-radius: 20px ;">mdi-check</v-icon>
                                Protect margin at the point of purchase</li>
                        </ul>
                        <p class="text-body-2">If Autoboli aligns with how you buy, choose a plan and start bidding with confidence.</p>

                    </div>
                </v-col>
                <v-col>
                    <div class="d-flex flex-lg-row flex-md-row flex-column-reverse bg-surface border justify-center pa-lg-10 pa-md-5 pa-4  mt-10 mt-lg-0 mt-md-0 w-100 " style=" border-radius:15px; ">
                     
                            <div class="pr-2  ">
                                <h3 class="text-lg-h5 font-weight-bold text-md-h5">Features</h3>
                                <ul style="list-style: none ;" class="d-flex flex-column ga-2 flex-wrap my-5">

                                    <li>
                                        <v-icon color="primary">mdi-check</v-icon>
                                        <span class="px-2 ">
                                            Live auction tracking</span>
                                    </li>

                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2">
                                            Vehicle valuations <span class="text-body-2">(CAP & AutoTrader)</span>
                                        </span>
                                    </li>

                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2"> Reauction
                                            detection
                                            & alerts</span>
                                    </li>
                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2">Auction & bidding
                                            history</span>
                                    </li>
                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2"> Watchlists &
                                            reminders</span> </li>
                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2"> UK
                                            auction-focused
                                            data</span> </li>
                                </ul>
                            </div>
                            <div class=" text-center w-100  w-lg-50">
                                <div class=" pt-1 d-flex flex-column justify-lg-end mb-5 w-100 w-lg-100"
                                    style="width:320px; height:260px; border-radius:15px; border:1px solid rgb(var(--v-theme-primary)); background-color: rgb(var(--v-theme-primary),0.3);">
                                    <p class="text-center mb-2" style="font-weight: bold ;">Smart bidder</p>

                                    <div class="bg-background d-flex flex-column align-center justify-space-evenly "
                                        style="width:100%; height:220px; border-radius:15px; bottom:0px;">
                                        <p class="text-body-2">Built for active dealers & traders</p>
                                        <div class="d-flex align-center text-h6">
                                            <p>£</p>
                                            <p class="text-h4 font-weight-bold">2.49</p>
                                            <p>/mo</p>
                                        </div>

                                        <router-link to="/checkout" style="width: 80%; height:40px;">
                                        <v-btn variant="flat" color="primary "
                                            style="border-radius:10px; "
                                            class="text-capitalize">Get Started</v-btn>
                                    </router-link></div>

                                </div>

                           
                        </div>



                    </div>
                </v-col>
            </v-row>
        </main>
    </div> -->

    <!--<pricingplain/> -->
    <!-- <featureTable/> -->
</template>


<script>
import PricePlanDes from './pricePlan.json'
import General from '@/models/general.model';
import api from '@/plugins/axios';
import { useUserStore } from '@/stores/userStore';
// import pricingplain from './pricingplain.vue';
// import featureTable from './featureTable.vue';
export default {
    name: "pricing",
    data() {
        return {
            userStore: useUserStore(),
            data: [],
            PricePlanDes,
            loading: false,
            price: [
                {
                    id: 1,
                    planType: 'Most Popular',
                    title: 'Free',
                    des: 'For small dealers.',
                    price: '0.00',
                },
                {
                    id: 2,
                    planType: 'Most Popular',
                    title: 'Ulta',
                    des: 'For medium-sized businesses.',
                    price: '100.00',
                },
                {
                    id: 3,
                    planType: 'Most Popular',
                    title: 'Plus',
                    des: 'For larger operations.',
                    price: '50.00',
                },

            ],
            problemItems: [
                'Overbidding due to incomplete market insight',
                'Missed opportunities hidden across different auction houses',
                'Losses caused by unseen condition issues or misleading valuations',
                'Hours wasted switching between platforms, spreadsheets, and guesswork'
            ]
        }
    },
    mounted() {
        this.getPlan()
    },
    methods: {
        async getPlan() {
            this.loading = false
            try {
                let res = await General.get("/api/cruds/plans")
                this.data = res.data.filter(plan => plan.status === 1);
                this.loading = true
            } catch (error) {
                console.error(error)
            } finally {
                this.loading = false
            }
        },
        discountPrice(item) {
            if (!item.discount) return item.price

            return (
                item.price - (item.price * item.discount) / 100
            ).toFixed(2)
        }
    }
}
</script>

<style scoped></style>