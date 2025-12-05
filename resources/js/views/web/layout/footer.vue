<template>
    <div class="bg-surface">

        <v-container style="max-width: 1600px; justify-content: center; padding: 60px;"  > 
            <div >
                <h1
                    class="text-h5 font-weight-bold text-on-primary mb-4 text-center d-flex flex-column align-center align-lg-start ">
                    AUTOBOLI Ltd</h1>
                <p
                    class="mb-10 text-body-2 text-light_text_on sm:w-100 text-center text-lg-start d-flex flex-column align-center align-lg-start ">
                    Helping dealers, exporters, and traders buy smarter with real-time auction data from across the UK &
                    <br> Japan. Save money, reduce risk, and grow your automotive business — all in one platform.
                </p>
            </div>

            <div class="d-flex justify-center">
                <v-row class="justify-md-center md-text-center">

                    <v-col cols="12" sm="6" md="3" lg="3"
                        class="text-center d-flex flex-column align-center align-lg-start  ">
                        <p class="text-body-1 font-weight-medium ">AutoBoli</p>
                        <v-list class="bg-surface text-text_light text-body-2">about us</v-list>
                        <v-list class="bg-surface text-text_light text-body-2">customer</v-list>
                        <v-list class="bg-surface text-text_light text-body-2">community</v-list>
                        <v-list class="bg-surface text-text_light text-body-2">Affiliate & Referrals</v-list>
                    </v-col>

                    <v-col cols="12" sm="6" md="3" lg="3"
                        class="text-center d-flex flex-column align-center align-lg-start ">
                        <p class="text-body-1 font-weight-bold">Learn</p>
                        <v-list v-for="value in [1, 2, 3, 4]"
                            class="bg-surface text-text_light text-body-2">Action</v-list>
                    </v-col>

                    <v-col cols="12" sm="6" md="3" lg="3"
                        class="text-center d-flex flex-column align-center align-lg-start ">
                        <p class="text-body-1 font-weight-bold">Resources</p>
                        <v-list class="bg-surface text-text_light text-body-2">News</v-list>
                        <v-list class="bg-surface text-text_light text-body-2"> Brand</v-list>
                        <v-list class="bg-surface text-text_light text-body-2">Bidding</v-list>
                        <v-list class="bg-surface text-text_light text-body-2">Roadmap</v-list>
                    </v-col>

                    <v-col cols="12" sm="6" md="3" lg="3"
                        class="text-center d-flex flex-column align-center align-lg-start ">
                        <p class="text-body-1 font-weight-bold">Contact</p>
                        <v-list class="bg-surface text-text_light text-body-2">Instagram</v-list>
                        <v-list class="bg-surface text-text_light text-body-2">Facebook</v-list>
                        <v-list class="bg-surface text-text_light text-body-2">X</v-list>
                        <v-list class="bg-surface text-text_light text-body-2">Tiktok</v-list>
                    </v-col>

                </v-row>
            </div>
            <div class="bg-shadow mx-auto mt-10" style="height: 0.5px; width: 98% ;"></div>
            <div>
                <p
                    class="text-body-2 mb-2  mt-10 font-weight-thin text-text_light text-center d-flex flex-column align-center align-lg-start ">
                    &copy; AUTOBOLI Ltd 2025. All rights reserved. </p>
                <p
                    class="text-body-2 mt-5 font-weight-thin text-text_light text-center d-flex flex-column align-center align-lg-start ">
                    Proudly built & hosted with secure infrastructure in the UK & EU. </p>
            </div>
        </v-container>
    </div>

</template>

<script>
import footerElement from "@/enums/WebfooterMenu.js"
export default {
    data() {
        return {
            drawer: false,
            footerElement: footerElement,

        }
    }
}

</script>