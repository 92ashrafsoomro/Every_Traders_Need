<template>
    <section class="bg-primary py-16">
        <v-container  fluid max-width="1400px"
            class="d-flex justify-content-center align-content-center py-md-20">
            <v-row no-gutters align="center">
                <v-col cols="12" lg="6">
                    <img :src="rightImage" alt="" class="missionImage">
                </v-col>
                <v-col cols="12" lg="6">
                    <div class="pl-0 pl-md-8">
                        <h2 class="text-h2 font-weight-bold text-white mb-8 mt-10 mt-lg-0">Our Vision</h2>
                        <div>
                            <p class="text-h6 mb-6  mr-6 ">Our vision is to become the most trusted auction intelligence
                                platform for the automotive trade.</p>
                            <p class="text-h6 mb-6  mr-6">We believe:</p>
                            <div class="ml-2 mb-2" v-for="item in [
                                'Better data leads to better decisions',
                                'Better decisions lead to better margins',
                                'Transparency creates a stronger trading ecosystem'
                            ]" :key="item">
                                <div class="d-flex align-center">
                                    <v-icon color="white" class="mr-2 mt-1">
                                        mdi-check-circle
                                    </v-icon>

                                    <span class="text-body-1">
                                        {{ item }}
                                    </span>
                                </div>
                            </div>

                        </div>

                            <p class="text-h6 mt-10 mr-6 ">We’re not here to replace auctions — we’re here to help you
                                win at them.</p>
                    </div>
                </v-col>



            </v-row>
        </v-container>
    </section>
</template>

<script>
import rightImage from '@/assets/images/tabs/mission.png'
export default {
    name: 'VisionSection',
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
