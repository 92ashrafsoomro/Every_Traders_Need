<template>
    <div class=" bg-surface">
        <div class="mx-auto bg-white" style="max-width: 1400px;">
            <v-sheet class="d-flex flex-column align-center justify-center" style="padding-top: 100px; padding-bottom: 100px;">

                <!-- Logo -->
                <img :src="AfterAutoboliImage" style="max-width:200px" alt="Autoboli Logo" />

                <!-- Titles -->
                <div class="text-center mb-10">
                    <h2 class="text-lg-h3 font-weight-bold">We show dealers what matters before they bid</h2>
                    <p class="d-flex w-75    mx-auto text-lg-h6  pa-4" style="font-weight: 400; ">
                    Autoboli V1 brings together live auctions, valuations, and reauction insights in one dashboard — helping dealers and traders make smarter decisions with real data, not guesswork.
</p>
                </div>

                <!-- Benefits Wrapper -->

               <div class="benefits-container justify-center w-100 d-flex flex-wrap gap-6">


                    <div v-for="(item, index) in visibleItems" :key="index" class="benefit-item ">
                     <div class="pa-3 ">
                           <v-card class="pa-3 pa-md-4 d-flex flex-column flex-md-row w-100 border-none align-center" style="background-color: rgb(var(--v-theme-primary),0.1);" >
                            <div class="icon-box">
                                <img :src="item.image" width="150" height="150" />
                            </div>

                            <div class="text-white ml-4">
                                <h6 class="text-body-2 font-weight-medium mb-2 text-whiteLight">
                                    {{ item.title }}
                                </h6>
                                <p class="text-body-2  mb-0 text-light_text_on">
                                    {{ item.description }}
                                </p>
                            </div>
                        </v-card>
                     </div>
                    </div>

                </div>
                <div class="mt-16">
                    <!-- <v-btn class=" " variant="flat" color="primary" rounded=""> -->
                      <!-- <span class="text-capitalize" >View More</span> -->
                       <AppButton text="View More" to="/" icon="mdi-arrow-down"  v-if="showLimit < allItems.length"  @click="showLimit = allItems.length"/>
                    <!-- </v-btn> -->
                    <!-- <v-btn class="w-100 h-75 pa-4" @click="showLimit = 6" v-else="" variant="flat" color="primary" rounded=""> -->
                          <!-- <span class="text-capitalize">View Less</span> -->
                            <AppButton text="View Less" to="/"   icon="mdi-arrow-up"  @click="showLimit = 6" v-else=""/>
                    <!-- </v-btn> -->

                </div>



            </v-sheet>
        </div>
    </div>
</template>

<script>
import AfterAutoboliImage from "@/assets/images/hero/heroAutoboliSmart.png"
import afterImages from "@/assets/images/smarter/smarter1.png"
import AppButton from "../component/AppButton.vue";
export default {

    name: 'AfterAutoboli',
    components:{
        AppButton,
    },
    data() {
        return {
            AfterAutoboliImage,
            showLimit: 4,
            
            afterData: [
                {
                    title: "Track live auction activity",
                    description:
                        "See today’s auctions, completed vs remaining lots, and reauction counts at a glance so you always know what’s happening right now.",
                    image: `${afterImages}`
                },
                {
                    title: "Find the right vehicles faster",
                    description:
                        "Use Auction Finder with smart filters to browse last month’s and upcoming lots in a clean table view — no wasted time, no noise.",
                    image: `${afterImages}`
                },
                {
                    title: "Compare prices before you bid",
                    description:
                        "Instantly view CAP, AutoTrader, trade, and retail values side by side to understand true market value before placing any bid.",
                    image: `${afterImages}`
                },
                {
                    title: "See full vehicle details in one place",
                    description:
                        "Access images, inspection summaries, auction details, and complete vehicle information without switching platforms.",
                    image: `${afterImages}`
                },
                {
                    title: "Identify reauction vehicles",
                    description:
                        "Spot vehicles that return to auction, review previous results, and compare past vs current data to avoid risky repeats.",
                    image: `${afterImages}`
                },
                {
                    title: "Plan auctions with confidence",
                    description:
                        "View upcoming auction schedules by day, auction house, and center — with clear status indicators and personal reminders.",
                    image: `${afterImages}`
                },
                {
                    title: "Stay informed, not overwhelmed",
                    description:
                        "Watch vehicles you care about, receive reauction alerts, and control notifications via email or browser — only what matters to you.",
                    image: `${afterImages}`
                },
                
            ]
        }
    },

    computed: {
        allItems() {
            return [...this.afterData]
        },
        visibleItems() {
            return this.allItems.slice(0, this.showLimit)
        }
    }
}
</script>

<style scoped>
.min-vh-100 {
    min-height: 100vh;
}

/* Optional glow effect to match the logo's blue glow */
.glow-effect {
    filter: drop-shadow(0 0 20px rgba(0, 191, 255, 0.8));
}
.benefits-container {
    max-width: 1400px;
    margin: 0 auto;
}

.benefit-item {
    width: calc(50% - 16px);
    /* left + right, with gap */
}

@media (max-width: 960px) {
    .benefit-item {
        width: 100%;
        /* mobile par single column */
    }
}
</style>