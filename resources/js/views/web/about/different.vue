<template>
    <v-container fluid class="bg-surface " style="padding: 100px 0 100px 0" >
        <v-container max-width="1400px">
            <!-- Heading -->
            <div class="text-center mb-12">
                <h2 class="text-lg-h3 text-md-h3 text-h4  font-weight-bold mb-4" style="  line-height: 1.2;">
                    What Makes Autoboli Different
                </h2>
                <p class=" w-lg-75 w-md-75 w-100    mx-auto text-lg-h6  text-light_text_on">
                    One Platform. Total Auction Intelligence.
                </p>
            </div>


            <v-row align="stretch" >
                <!-- LEFT SIDE -->
                <v-col cols="12" md="6">
                    <v-row class="" align="stretch">

                        <!-- Card 1 -->
                        <v-col cols="12">
                            <div class="pa-6  rounded-xl h-100 border-sm" style="background-color: #3399ff10;">
                                <v-row align="center" no-gutters>
                                    <v-col cols="12" md="5">
                                        <v-img :src="differentImage" height="160" contain class="rounded-lg" />
                                    </v-col>
                                    <v-col cols="12" md="7" class="pl-4">
                                        <h3 class="text-lg-h6 mt-4 font-weight-bold text-whiteLight mb-2">
                                            One Platform. Total Auction Intelligence.
                                        </h3>
                                        <p class="text-lg-body-1">
                                            Autoboli brings everything together in one place — fast and structured.
                                        </p>
                                    </v-col>

                                   
                                </v-row>
                            </div>
                        </v-col>

                        <!-- Card 2 -->
                        <v-col cols="12">
                            <div class="pa-6 rounded-xl h-100 border-sm" style="background-color: #3399ff10;">
                                <v-row align="center" no-gutters>
                                    <v-col cols="12" md="5" >
                                        <v-img :src="differentImage" height="160" contain class="rounded-lg" />
                                    </v-col>
                                    <v-col cols="12" md="7" class="pl-4">
                                        <h3 class="text-lg-h6 mt-4 font-weight-bold text-whiteLight mb-2">
                                            Built for Dealers & Traders
                                        </h3>
                                        <p class="text-lg-body-1">
                                            Designed for professionals — not consumers.
                                        </p>
                                    </v-col>

                                  
                                </v-row>
                            </div>
                        </v-col>

                    </v-row>
                </v-col>

                <!-- RIGHT SIDE -->
                <!-- RIGHT SIDE -->
                <v-col cols="12" md="6">
                    <v-card class="pa-8 rounded-xl h-100 border-sm" style="background-color: #3399ff10;">

                        <!-- IMPORTANT: h-100 on v-row -->
                        <v-row no-gutters class="h-100">

                            <v-col cols="12" md="5" class="d-flex align-center justify-center"
                                style="min-height: 200px;">
                                <v-img :src="differentImage" class="rounded-lg" height="100%" width="100%" cover />
                            </v-col>

                            <v-col cols="12" md="7" class="pl-md-6 d-flex flex-column justify-center">
                                <h3 class="text-lg-h6 mt-4 font-weight-bold text-whiteLight mb-4">
                                    Smarter Insights, Not Just Raw Data
                                </h3>

                                <v-list density="compact" bg-color="transparent">
                                    <v-list-item v-for="item in [
                                        'True market value',
                                        'Risk vs reward',
                                        'Profit potential',
                                        'Reauction signals',
                                        'Demand trends'
                                    ]" :key="item">
                                        <template #prepend >
                                            <v-icon color="primary">mdi-check-circle</v-icon>
                                        </template>

                                        <v-list-item-title class="text-whiteLight">
                                            {{ item }}
                                        </v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-col>

                        </v-row>
                    </v-card>
                </v-col>


            </v-row>


        </v-container>
    </v-container>
</template>

<script>
import differentImage from '@/assets/images/reauction/differentimg.png'
export default {
    data() {
        return {
            differentImage
        }
    }
}
</script>

<style scoped>
.div {
    background: rgb(var(--v-theme-background));
}

.image-placeholder {
    height: 530px;
    background: linear-gradient(135deg, #7c3aed, #a78bfa);
}
</style>