<template>
    <v-container fluid class="pa-0 " style="margin-top: 50px;">
        <v-container style="max-width: 1400px;">

            <h1 class="text-lg-h4 text-md-h6 text-h6 font-weight-bold text-center mb-12">
                Best Smartphones Under 80,000 PKR in 2026 – Full Comparison
            </h1>

            <v-row align="center" class="mb-12 rounded-lg" style="background-color: rgb(var(--v-theme-surface));">
                <v-col cols="12" md="7">
                    <h4 class="text-h5 font-weight-bold mb-6">Maximizing Efficiency in Operations</h4>
                    <div class="text-body-1  mb-6 text-light_text_on" style="line-height: 1.9;">
                        We offer a comprehensive range of services designed to meet the unique needs of your business.
                        From strategy development, risk management, our expert team is dedicated to driving success.
                    </div>
                    <div class="text-body-1">
                        Updated: March 2026 • 12 min read
                    </div>
                </v-col>

                <v-col cols="12" md="5" class="text-center">
                    <v-img
                        src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=1470"
                        alt="Smartphones 2026" class="rounded-lg elevation-6" max-width="520"
                        style="margin: 0 auto;"></v-img>
                </v-col>
            </v-row>

            <!-- H2 Section -->
            <h2 class="text-h4 font-weight-bold pa-4 text-center"
                style="background-color: rgb(var(--v-theme-primary),0.2);">
                Top Smartphones Under 80K Right Now
            </h2>

            <div class="px-4 py-8 mt-12" style="background-color: rgb(var(--v-theme-surface),0.4);">

                <h3 class="text-h5 font-weight-bold  mb-4">
                    1. Poco F7 Pro – Best Performance King
                </h3>
                <p class="text-body-1 mb-4" style="line-height: 1.8;">
                    Snapdragon 8s Gen 4, 120W charging, 144 Hz AMOLED, 200 MP main camera — Poco once again brings
                    flagship-level performance at mid-range pricing.
                </p>
                <v-btn text color="primary" to="/" target="_blank" class="mt-3">
                    View full specifications on GSMArena
                </v-btn>
            </div>
            <v-divider class="ps-0 pr-0"></v-divider>
            <div class="px-4 py-8 mt-12" style="background-color: rgb(var(--v-theme-surface),0.4);">
                <h3 class="text-h5 font-weight-bold  mb-4">
                    2. Samsung Galaxy A56 – Best Software & Updates
                </h3>
                <p class="text-body-1 mb-4" style="line-height: 1.8;">
                    6 years of OS updates + 7 years of security patches make Galaxy A56 the safest long-term investment
                    in
                    this price segment.
                </p>


                <v-btn text color="primary" to="/" target="_blank" class="mt-3">
                    View full specifications on GSMArena
                </v-btn>
            </div>
            <v-divider class="ps-0 pr-0"></v-divider>

            <!-- Charts / Visuals -->
            <v-row class="my-12">
                <v-col cols="12" md="4">
                    <v-card class=" rounded-lg elevation-4">
                      <v-img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=1470"  style="width:100%; height:100%; object-fit:cover;"/>
                    <div class="pa-4 text-center">
                        Maximizing Efficiency in Operations
                    </div>
                    </v-card>
                </v-col>
               <v-col cols="12" md="4">
                    <v-card class=" rounded-lg elevation-4">
                      <v-img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=1470"  style="width:100%; height:100%; object-fit:cover;"/>
                    <div class="pa-4 text-center">
                        Maximizing Efficiency in Operations
                    </div>
                    </v-card>
                </v-col>
                 <v-col cols="12" md="4">
                    <v-card class=" rounded-lg elevation-4">
                      <v-img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=1470"  style="width:100%; height:100%; object-fit:cover;"/>
                    <div class="pa-4 text-center">
                        Maximizing Efficiency in Operations
                    </div>
                    </v-card>
                </v-col>
            </v-row>

            <!-- Call to Action -->
            <v-card class="pa-12 my-12 text-center " color="primary" elevation="12" rounded="xl">
                <div class="text-h4 font-weight-bold mb-6">
                    Confused which phone to buy?
                </div>
                <div class="text-subtitle-1 mb-8" style="max-width: 680px; margin: 0 auto;">
                    Get personalized recommendation in 60 seconds — answer 5 quick questions
                </div>
                <v-btn color="white" class="text-primary font-weight-bold text-body-1"  rounded>
                    Find My Perfect Phone
                </v-btn>
            </v-card>

            <!-- Conclusion -->
           <div class="bg-surface py-4 rounded-lg">
             <h2 class="text-h4 font-weight-bold text-center">
                Final Thoughts
            </h2>
            <div class="text-body-1 text-center mx-auto" style=" line-height: 1.85;">
               <ul style="list-style: none;">
                <li v-for="value in [1,2,3,4]">
                  <v-icon color="primary" class="mr-3">
                    mdi-check-circle
                  </v-icon>  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                </li>
               </ul>
            </div>
           </div>

        </v-container>
    </v-container>
</template>

<script>
export default {
    name: 'BlogPostExample'
}
</script>

<style scoped>
/* Only fallback / override styles — most things handled by Vuetify now */
h2 {
    border-bottom: 3px solid var(--v-primary-base);
}
</style>