<template>
    <div style="width: auto; " class="bg-surface  ">
        <div style="max-width: 1400px;" class="mx-auto bg-background">
            <v-sheet class="d-flex flex-column align-center justify-center pa-8">
                <!-- Logo -->
                <img :src="AfterAutoboliImage" max-width="200" alt="Autoboli Logo" />

                <!-- Titles -->
                <div class="text-center mb-10">
                    <h1 class="text-h3 text-white font-weight-bold mb-2">After Autoboli</h1>
                    <h2 class="text-h4 text-white font-weight-medium">The Smarter Way</h2>
                </div>

                <!-- Benefits Grid -->
                <v-row justify="center" class="w-100">
                    <v-col cols="12" md="10" lg="8">
                        <v-row>

                            <!-- Left Column -->
                            <v-col cols="12" sm="6">
                                <div v-for="n in 5" :key="'left-' + n" class="mb-6">
                                    <v-card class="pa-3 pa-md-4 d-flex flex-column flex-md-row ga-3"
                                        style="background-color: #3399ff20;" elevation="6">
                                        <div class="w-lg-25 h-lg-25 bg-primary d-flex text-center rounded-lg mt-1"> <v-icon
                                                color="#fff" size="40" class="ma-2 font-weight-bold">mdi-check</v-icon>
                                                </div>

                                        <div class="text-white">
                                            <h6 class="text-body-2 font-weight-medium mb-2">
                                                One dashboard. All auctions. Total clarity.
                                            </h6>
                                            <p class="text-body-2 text-text_light mb-0">
                                                Everything comes together — thousands of lots, valuations,
                                                history, predictions.
                                            </p>
                                        </div>
                                    </v-card>
                                </div>
                            </v-col>

                            <!-- Right Column -->
                            <v-col cols="12" sm="6">
                                <div v-for="n in 5" :key="'right-' + n" class="mb-6">
                                    <v-card class="pa-3 pa-md-4 d-flex flex-column flex-md-row ga-3"
                                        style="background-color: #3399ff20;" elevation="6">
                                        <div class="w-lg-25 h-lg-25 bg-primary d-flex text-center rounded-lg mt-1"> <v-icon
                                                color="#fff" size="40" class="ma-2 font-weight-bold">mdi-check</v-icon>
                                                </div>
                                            <div class="text-white">
                                                <h6 class="text-body-2 font-weight-medium mb-2">
                                                    One dashboard. All auctions. Total clarity.
                                                </h6>
                                                <p class="text-body-2 text-text_light mb-0">
                                                    Everything comes together — thousands of lots, valuations,
                                                    history, predictions.
                                                </p>
                                            </div>
                                    </v-card>
                                </div>
                            </v-col>

                        </v-row>
                    </v-col>
                </v-row>
            </v-sheet>
        </div>
    </div>

</template>

<script>
import AfterAutoboliImage from "@/assets/images/hero/heroAutoboliSmart.png"

export default {

    name: 'AfterAutoboli',
    data() {
        return {
            AfterAutoboliImage
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
</style>