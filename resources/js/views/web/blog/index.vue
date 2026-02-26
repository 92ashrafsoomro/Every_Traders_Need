<template>
    <div style="margin-top: 100px;">
        <!-- Main Blog & Articles Section -->
        <div class="mx-auto" style="max-width: 1400px;">
            <h1 class="text-h4 font-weight-bold mb-6">Blog & articles</h1>

            <!-- Category Chips -->
            <v-chip-group v-model="selectedCategory" mandatory class="mb-8">
                <v-chip v-for="category in categories" :key="category" :value="category" color="primary"
                    variant="outlined" class="mr-3 text-capitalize">
                    {{ category }}
                </v-chip>
            </v-chip-group>

            <!-- Featured Card (Large one) -->
            <div class=" rounded-lg d-flex d-flex-wrap ">
                <div class="">
                    <img :src="featuredImage" height="380" width="700" />
                </div>


                <div class="pl-10  d-flex flex-column" style="height: 380px;">

                    <!-- Text Content -->
                    <div>
                        <v-chip small color="primary" class="ma-3 text-caption font-weight-medium">
                            News
                        </v-chip>
                        <div class="text-h5 font-weight-bold text-white pa-6">
                            Maximizing Efficiency in Operations
                        </div>

                        <div class="text-white pa-6 pt-0">
                            We offer a comprehensive range of services designed to meet the unique needs of your
                            business.
                            From strategy development, risk management, our expert team is dedicated to driving success.
                        </div>
                    </div>

                    <!-- Button Bottom -->
                    <div class="mt-auto pa-6">
                        <router-link to="/" style="text-decoration: none;">
                            <div class="button d-flex justify-space-between bg-primary align-center pa-3"
                                style="min-width:150px; max-width:200px; border-radius:40px;">

                                <div class="text ml-2 mr-2">
                                    View Detail
                                </div>

                                <div class="icon bg-white rounded-xl pa-1">
                                    <v-icon>mdi-arrow-top-right</v-icon>
                                </div>
                            </div>
                        </router-link>
                    </div>

                </div>
            </div>

            <!-- Latest Insights Title -->

        </div>
        <div class="bg-surface py-12">
            <div class="mx-auto" style="max-width: 1400px;">


                <div class="d-flex align-center mb-6 pt-6">
                    <v-icon color="primary" left class="mr-2">mdi-lightbulb-outline</v-icon>
                    <h2 class="text-h5 font-weight-medium">Latest insights and trends</h2>
                </div>

                <!-- Grid of Small Cards -->
                <v-row dense="">
                    <!-- <v-col v-for="(item, i) in latestArticles" :key="i" cols="12" sm="6" md="4" lg="3" > -->
                    <v-col v-for="(item, i) in latestArticles" :key="i">
                        <div class="rounded-lg  h-100 ml-2  d-flex flex-column" hover
                            style="background-color: rgb(var(--v-theme-background)); width:400px;">
                            <div style="width:100%; height:180px; position:relative; overflow:hidden;">
                                <img :src="item.image" style="width:100%; height:100%; object-fit:cover;" />

                                <!-- Gradient Overlay (optional but recommended) -->
                                <div style="
                                        position:absolute;
                                        inset:0;
                                        background: linear-gradient(to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5));
                                    "></div>

                                <!-- Chip -->
                                <v-chip small color="primary" class="ma-3 text-caption font-weight-medium"
                                    style="position:absolute; top:0; left:0;">
                                    News
                                </v-chip>

                            </div>
                           <div class="pa-2">
                             <p class="text-subtitle-1 font-weight-medium py-3">
                                {{ item.title }}
                            </p>

                            <p class="text-body-2 grey--text text--darken-1 flex-grow-1">
                                {{ item.description }}
                            </p>

                          
                                <v-btn variant="elevated" color="primary" class="text-capitalize pa-2 mt-3"  >
                                    Read more
                                </v-btn>
                           </div>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </div>
    </div>
</template>

<script>
import lightLogo from "@/assets/images/header/lightfull.png";

export default {
    name: 'BlogSection',

    data: () => ({
        lightLogo,
        selectedCategory: 'All',
        categories: ['All', 'Marketing Tips', 'Business Strategies', 'Industry Insights', 'Client Success'],

        featuredImage: 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=1470', // man & woman talking

        latestArticles: [
            {
                image: 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=1470', // woman with laptop
                title: 'Maximizing Efficiency in Operations',
                description: 'Discover strategies to streamline your business processes and enhance productivity.'
            },
            {
                image: 'https://images.unsplash.com/photo-1551836022-4c4c79ecde6b?auto=format&fit=crop&q=80&w=1470', // woman doctor
                title: 'Maximizing Efficiency in Operations',
                description: 'Discover strategies to streamline your business processes and enhance productivity.'
            },
            {
                image: 'https://images.unsplash.com/photo-1552581231-26160f608093?auto=format&fit=crop&q=80&w=1470', // man writing
                title: 'Maximizing Efficiency in Operations',
                description: 'Discover strategies to streamline your business processes and enhance productivity.'
            },
            {
                image: 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=1470',
                title: 'Maximizing Efficiency in Operations',
                description: 'Discover strategies to streamline your business processes and enhance productivity.'
            },
            {
                image: 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=1470',
                title: 'Maximizing Efficiency in Operations',
                description: 'Discover strategies to streamline your business processes and enhance productivity.'
            },
            {
                image: 'https://images.unsplash.com/photo-1552581231-26160f608093?auto=format&fit=crop&q=80&w=1470',
                title: 'Maximizing Efficiency in Operations',
                description: 'Discover strategies to streamline your business processes and enhance productivity.'
            }
        ]
    })
}
</script>

<style scoped>
/* Minimal overrides only — mostly relying on Vuetify */
.v-chip-group {
    flex-wrap: wrap;
}

.v-card__title {
    line-height: 1.3;
}
</style>