<template>
    <v-container>
        <main style="max-width: 1400px; height: 1000px; padding: 100px 0 100px 0;" class="mx-auto">
            <div class="d-flex text-center items-center justify-center py-16">
                <h1 class="text-h2 font-weight-bold">Pricing</h1>
            </div>
            <v-row>
                <v-col>
                    <div class="d-flex flex-column justify-center  h-100 w-75">
                        <p>Hi there!</p>
                        <p>Buying stock at auction is fast, competitive, and risky.
                        </p>
                        <p>Autoboli was built to reduce that risk by giving you clear vehicle intelligence, valuations,
                            and reauction signals — all in one place.
                            You can explore Autoboli with limited access, but upgrading unlocks the tools that help you:
                        </p>
                        <ul class="ml-4 my-6" style="list-style: none;">
                            <li><v-icon color="" class="mr-2  " style="width: 30px; height: 30px; margin-top: 5px; background-color: rgb(var(--v-theme-primary),0.3); border-radius: 20px ;">mdi-check</v-icon> Avoid bad stock</li>
                            <li> <v-icon color="" class="mr-2  " style="width: 30px; height: 30px; margin-top: 5px; background-color: rgb(var(--v-theme-primary),0.3); border-radius: 20px ;">mdi-check</v-icon>  Save hours each week</li>
                            <li> <v-icon color="" class="mr-2  " style="width: 30px; height: 30px; margin-top: 5px; background-color: rgb(var(--v-theme-primary),0.3); border-radius: 20px ;">mdi-check</v-icon>  Protect margin at the point of purchase</li>
                        </ul>
                        <p>If Autoboli aligns with how you buy, choose a plan and start bidding with confidence.</p>

                    </div>
                </v-col>
                <v-col>
                    <div class="right bg-surface border mr-lg-10 w-100 " style=" border-radius:15px; ">
                        <!-- box-shadow:0px 0px 20px 0px rgb(var(--v-theme-shadow)); -->
                        <div class="d-flex  justify-space-between pa-10 ">
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

                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2"> Reauction detection
                                            & alerts</span>
                                    </li>
                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2">Auction & bidding
                                            history</span>
                                    </li>
                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2"> Watchlists &
                                            reminders</span> </li>
                                    <li><v-icon color="primary">mdi-check</v-icon> <span class="px-2"> UK auction-focused
                                            data</span> </li>
                                </ul>
                            </div>
                            <div class=" text-center">
                                <div class=" pt-1 d-flex flex-column justify-lg-end mb-5"
                                    style="width:240px; height:260px; border-radius:15px; border:1px solid rgb(var(--v-theme-primary)); background-color: rgb(var(--v-theme-primary),0.3);">
                                    <p class="text-center mb-2" style="font-weight: bold ;">Smart bidder</p>

                                    <div class="bg-background d-flex flex-column align-center justify-space-evenly "
                                        style="width:100%; height:220px; border-radius:15px; bottom:0px;">
                                        <p class="text-body-2">Built for active dealers & traders</p>
                                        <div class="d-flex align-center text-h6">
                                            <p>£</p>
                                            <p class="text-h4 font-weight-bold">2.49</p>
                                            <p>/mo</p>
                                        </div>

                                        <v-btn variant="flat" color="primary "
                                            style="border-radius:10px; width: 80%; height:40px;"
                                            class="text-capitalize">Get Started</v-btn>
                                    </div>

                                </div>

                            </div>
                        </div>



                    </div>
                </v-col>
            </v-row>
        </main>
    </v-container>

    <!--<pricingplain/> -->
    <!-- <featureTable/> -->
</template>


<script>
import pricingplain from './pricingplain.vue';
import featureTable from './featureTable.vue';

export default {

}
</script>

<style scoped></style>