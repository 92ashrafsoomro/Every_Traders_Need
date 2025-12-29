<template>
    <section class="bg-background " style="padding-top: 100px; padding-bottom: 100px;">
        <v-container  fluid max-width="1400px"
            class="d-flex justify-content-center align-content-center ">
            <v-row no-gutters align="center">

                <v-col cols="12" lg="6">
                    <div class="pl-0 pl-md-8">
                        <h2 class="text-h3 font-weight-bold text-white mb-8" style="  line-height: 1.2;">Helping You Avoid Costly Bidding Mistakes
                        </h2>
                        <div>
                            <div class=" border-sm pa-5 rounded-lg"
                                style="background-color: rgb(var(--v-theme-primary), 0.1);">
                                <p class=" text-body-1 font-weight-bold mr-6">Many losses happen before the bid is placed:</p>
                                <div v-for="item in [
                                    'Overestimating resale value',
                                    'Ignoring reauction history',
                                    'Missing condition red flags',
                                    'Choosing the wrong auction house'
                                ]" :key="item" class="d-flex align-center mb-2 mt-3">
                                    <v-icon color="primary" class="mr-2">mdi-check-circle</v-icon>
                                    <span class="text-body-2">{{ item }}</span>
                                </div>

                            </div>
                            <div class="mt-5 border-sm pa-5 rounded-lg"
                                style="background-color: rgb(var(--v-theme-primary), 0.1);">
                                <p class=" text-body-1 font-weight-bold mr-6">Autoboli helps you:</p>
                                <div v-for="item in [
                                    'Know the real value before bidding',
                                    'Spot risky vehicles early',
                                    'Compare auction houses side by side',
                                    'Plan ahead with live auction schedules'
                                ]" :key="item" class="d-flex align-center mb-2 mt-3">
                                    <v-icon color="primary" class="mr-2">mdi-check-circle</v-icon>
                                    <span class="text-body-2">{{ item }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </v-col>
                <v-col cols="12" lg="6" class="mt-lg-0 mt-10">
                    <img :src="rightImage" alt="" class="missionImage">
                </v-col>


            </v-row>
        </v-container>
    </section>
</template>

<script>
import rightImage from '@/assets/images/tabs/mission.png'
export default {
    name: 'BiddingSection',
    data() {
        return {
            rightImage
        }
    }
}
</script>

<style scoped>
.missionImage {
    width: 100%;
    max-width: 600px;
    border-radius: 12px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

@media (max-width: 960px) {
    .missionImage {
        max-width: 420px;
    }
}

@media (max-width: 600px) {
    .missionImage {
        max-width: 320px;
    }
}
</style>