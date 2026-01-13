<template>
    <div class="py-16" style="background-color:rgb(var(--v-theme-surface))">
        <v-container style="max-width:1300px">

            <!-- Heading -->
            <div class="text-center mb-14">
                <h2 class="text-h4 text-md-h3 font-weight-bold text-whiteLite mb-4">
                    What You Gain With Autoboli
                </h2>
                <p class="text-subtitle-1 text-light_text_on mx-auto" style="max-width:800px">
                    Make clearer decisions, reduce risks, and grow your profit with data-backed
                    insights designed for professional traders and dealers.
                </p>
            </div>

            <!-- Cards -->
            <v-row>
                <v-col cols="12" sm="6" md="4">
                    <v-card rounded="xl" elevation="12" color="surface" border class="pa-5 d-flex flex-column">

                        <!-- Image -->
                        <v-img :src="logo" rounded="lg" height="110" class="mb-5 border" />

                        <!-- Content -->
                        <div>
                            <h3 class="text-body-1 font-weight-semibold text-whiteLite mb-2">
                                What Makes Autoboli Different
                            </h3>

                            <p class="text-body-2 text-light_text_on mb-0">
                                Unlike traditional valuation tools or static vehicle lookup platforms, Autoboli gives
                                you:
                            </p>
                        </div>

                    </v-card>


                </v-col>
                <v-col cols="12" sm="6" md="4">
                    <v-card rounded="xl" elevation="12" color="surface" border class="pa-5 d-flex flex-column">

                        <!-- Image -->
                        <v-img :src="logo" rounded="lg" height="110" class="mb-5 border" />

                        <!-- Content -->
                        <div>
                            <h3 class="text-body-1 font-weight-semibold text-whiteLite mb-2">
                                What Makes Autoboli Different
                            </h3>

                            <p class="text-body-2 text-light_text_on mb-0">
                                Unlike traditional valuation tools or static vehicle lookup platforms, Autoboli gives
                                you:
                            </p>
                        </div>

                    </v-card>


                </v-col>
                <v-col cols="12" sm="6" md="4">
                    <v-card rounded="xl" elevation="12" color="surface" border class="pa-5 d-flex flex-column">

                        <!-- Image -->
                        <v-img :src="logo" rounded="lg" height="110" class="mb-5 border" />

                        <!-- Content -->
                        <div>
                            <h3 class="text-body-1 font-weight-semibold text-whiteLite mb-2">
                                What Makes Autoboli Different
                            </h3>

                            <p class="text-body-2 text-light_text_on mb-0">
                                Unlike traditional valuation tools or static vehicle lookup platforms, Autoboli gives
                                you:
                            </p>
                        </div>

                    </v-card>


                </v-col>
                <v-col cols="12" sm="6" md="4">
                    <v-card rounded="xl" elevation="12" color="surface" border class="pa-5 d-flex flex-column">

                        <!-- Image -->
                        <v-img :src="logo" rounded="lg" height="110" class="mb-5 border" />

                        <!-- Content -->
                        <div>
                            <h3 class="text-body-1 font-weight-semibold text-whiteLite mb-2">
                                What Makes Autoboli Different
                            </h3>

                            <p class="text-body-2 text-light_text_on mb-0">
                                Unlike traditional valuation tools or static vehicle lookup platforms, Autoboli gives
                                you:
                            </p>
                        </div>

                    </v-card>


                </v-col>
                <v-col cols="12" sm="6" md="4">
                    <v-card rounded="xl" elevation="12" color="surface" border class="pa-5 d-flex flex-column">

                        <!-- Image -->
                        <v-img :src="logo" rounded="lg" height="110" class="mb-5 border" />

                        <!-- Content -->
                        <div>
                            <h3 class="text-body-1 font-weight-semibold text-whiteLite mb-2">
                                What Makes Autoboli Different
                            </h3>

                            <p class="text-body-2 text-light_text_on mb-0">
                                Unlike traditional valuation tools or static vehicle lookup platforms, Autoboli gives
                                you:
                            </p>
                        </div>

                    </v-card>


                </v-col>
                <v-col cols="12" sm="6" md="4">
                    <v-card rounded="xl" elevation="12" color="surface" border class="pa-5 d-flex flex-column">

                        <!-- Image -->
                        <v-img :src="logo" rounded="lg" height="110" class="mb-5 border" />

                        <!-- Content -->
                        <div>
                            <h3 class="text-body-1 font-weight-semibold text-whiteLite mb-2">
                                What Makes Autoboli Different
                            </h3>

                            <p class="text-body-2 text-light_text_on mb-0">
                                Unlike traditional valuation tools or static vehicle lookup platforms, Autoboli gives
                                you:
                            </p>
                        </div>

                    </v-card>


                </v-col>
                
            </v-row>

        </v-container>
    </div>
</template>

<script>

import darkLogo from "@/assets/images/header/darkfull.png";
import lightLogo from "@/assets/images/header/lightfull.png";
import { useTheme } from 'vuetify';
export default {
    data() {
        return {
            theme : useTheme(),
        }
    },
    computed:{
        isDark(){
            return this.theme.global.name === 'adminDark';
        },
        logo(){
            return this.isDark ? darkLogo : lightLogo
        }
    },
    methods:{
        toggleTheme(){
            this.theme.change(this.isDark? 'adminLight' : 'adminDark')
        }
    }
}
</script>
