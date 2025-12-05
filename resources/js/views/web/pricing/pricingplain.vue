<template>
    <v-container fluid class="pa-10 bg-surface">
        <!-- Header Section -->
        <div class="text-center justify-center py-12 " style="margin-top: 100px;">
            <v-chip class="mb-4"  small>
                Monthly • Yearly <span class="text-subtitle-2 ml-2 text-primary">Up to 20% OFF</span>
            </v-chip>
            <h1 class="text-h3 font-weight-bold white--text mb-3">
                Flexible plans for AI content creators
            </h1>
            <p class="text-body-1 white--text opacity-80">
                Choose the best plan for your needs.
            </p>

            <!-- Billing Toggle -->
            <div class="mt-4 py-4">
              <v-btn class="border-md bg-primary" variant="elevated">Monthly</v-btn>
              <v-btn>Yearly</v-btn>
            </div>
        </div>

        <!-- Pricing Cards -->
        <v-container  >
            <v-row justify="center " no-gutters>
                <!-- Free -->
                <v-col cols="12" sm="6" md="3" lg="2">
                    <v-card elevation="8" class="h-100 d-flex  flex-column border-md pa-4"
                        style="background-color: rgb(225, 225, 225, 0.1);">
                        <div style="min-height: 150px; " class="text-center">
                            <v-card-title class="text-h6 font-weight-bold  py-6">
                                Free
                            <div class="text-h4 font-weight-bold mb-2 mt-1">£0 <small class="text-body-2">/month</small>
                            </div>
                           
                            </v-card-title>
                             <v-btn color="primary" class="text-capitalize " width="200px">Get Started</v-btn>

                        </div>
                        <v-card-text class="text-start flex-grow-1">
                            <v-divider class="my-6 border-" ></v-divider>

                            <ul class="text-left pa-0" style="list-style: none;">
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Generation — 3 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Editing — 1 project</li>
                            </ul>
                        </v-card-text>
                    </v-card>
                </v-col>

                <!-- Entry -->
                <v-col cols="12" sm="6" md="3" lg="2">
                    <v-card elevation="8" class="h-100 d-flex flex-column border-md pa-4"
                        style="background-color: rgb(225, 225, 225, 0.1);">
                        <div style="min-height: 150px;" class=" text-center ">
                            <v-card-title class="text-h6 font-weight-bold  py-6">
                                Entry
                                 <div class="text-h4 font-weight-bold mb-1 mt-2">£10 <small class="text-body-2">/month</small>
                            </div>
                            </v-card-title>
                           
                            <v-btn color="primary" class="text-capitalize " width="200px">Get Started</v-btn>

                        </div>
                        <v-card-text class="text-start flex-grow-1">
                              <v-divider class="my-6 border-" ></v-divider>



                            <ul class="text-left pa-0" style="list-style: none;">
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Generation — 9 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Video
                                    Generation — 18 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Editing — 5 projects</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Parallel
                                    jobs — 2 gens at a time</li>
                            </ul>
                        </v-card-text>
                    </v-card>
                </v-col>

                <!-- Core -->
                <v-col cols="12" sm="6" md="3" lg="2">
                    <v-card elevation="8" class="h-100 d-flex flex-column border-md pa-4"
                        style="background-color: rgb(225, 225, 225, 0.1);">

                        <div style="min-height: 150px;" class="text-center">
                            <v-card-title class="text-h6 font-weight-bold  py-6">
                                Core
                            <div class="text-h4 font-weight-bold mb-1 mt-2">£30 <small class="text-body-2">/month</small>
                            </div>
                            </v-card-title>
                           
                            <v-btn color="primary" class="text-capitalize " width="200px">Get Started</v-btn>

                        </div>

                        <v-card-text class="text-start flex-grow-1">
                              <v-divider class="my-6 border-" ></v-divider>


                            <ul class="text-left pa-0" style="list-style: none;">
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Generation — 10 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Video
                                    Generation — 24 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Editing — 15 projects</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Parallel
                                    jobs — 4 gens at a time</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Model
                                    Training</li>
                            </ul>
                        </v-card-text>
                    </v-card>
                </v-col>

                <!-- Plus (Most Popular) -->
                <v-col cols="12" sm="6" md="3" lg="2">

                    <v-chip  class="font-weight-bold bg-white text-white bg-primary rounded-sm"
                        style="position: absolute; margin-left: 90px; margin-top: -15px; z-index: 1;">Most popular</v-chip>
                    <v-card elevation="12" class="h-100 d-flex flex-column  rounded-lg"
                        style="background-color: rgb(225, 225, 225, 0.1); min-height: 620px; border: 1px solid blue;">
                        <div style="min-height: 150px;" class="pl-4 text-center">
                            <v-card-title class="text-h6 font-weight-bold  py-8">
                                Plus
                            <div class="text-h4 font-weight-bold mb-1 mt-2">£65 <small class="text-body-2">/month</small>
                            </div>
                      
                            </v-card-title>
                            <v-btn color="primary" bclass="" class="text-capitalize" width="200px">Get Started</v-btn>
                        </div>
                        <v-card-text class="text-start flex-grow-1">
                              <v-divider class="my-6 border-" ></v-divider>



                            <ul class="text-left pa-0" style="list-style: none;">
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Generation — 10 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Video
                                    Generation — 24 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Editing — 50 projects</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Parallel
                                    jobs — 8 gens at a time</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Model
                                    Training</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Top-up
                                    Credits</li>
                            </ul>
                        </v-card-text>
                    </v-card>
                </v-col>

                <!-- Ultra -->
                <v-col cols="12" sm="6" md="3" lg="2">
                    <v-card elevation="8" class="h-100 d-flex flex-column border-md pa-4"
                        style="background-color: rgb(225, 225, 225, 0.1);">
                        <div style="min-height: 150px;" class="text-center">
                            <v-card-title class="text-h6 font-weight-bold  py-6">
                                Ultra
                            <div class="text-h4 font-weight-bold mb-1 mt-2">£175 <small class="text-body-2">/month</small>
                            </div>
                           
                            </v-card-title>
                            <v-btn color="primary" class="text-capitalize " width="200px">Get Started</v-btn>

                        </div>
                        <v-card-text class="text-start flex-grow-1">

                              <v-divider class="my-6 border-" ></v-divider>


                            <ul class="text-left pa-0" style="list-style: none;">
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Generation — 10 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Video
                                    Generation — 24 AI models</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Image
                                    Editing — Unlimited projects</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Parallel
                                    jobs — 10 gens at a time</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Model
                                    Training</li>
                                <li class="mb-3 d-flex"><v-icon small color="primary" class="mr-2">mdi-check</v-icon>
                                    Top-up
                                    Credits</li>
                            </ul>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-container>
</template>

<script>

export default {
    data() {
        return {
            isYearly: false
        }
    }
}
</script>

