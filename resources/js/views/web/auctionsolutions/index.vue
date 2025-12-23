<template>
    <main>

        <!-- HERO -->
        <section class="aboutScreen py-16 d-flex align-center " style="background-color: #0A70FF;">
            <v-container style="max-width:1400px; " fluid="" class="d-flex align-center mx-auto ">

                <div class="hero-text" style="max-width: 900px;">

                    <!-- Small Heading -->
                    <span class="hero-about-heading text-on-primary">
                        Auction Solution
                    </span>

                    <!-- Main Heading -->
                    <h1 class="text-white text-h2 font-weight-bold  mt-3" style="line-height: 1.1; ">
                        The Real Problems Dealers & Traders Face at Auctions And How Autoboli Solves Them
                    </h1>
                    <p class="text-h6 text-md-h5">Autoboli exists to remove uncertainty from auction buying and replace
                        it
                        with clarity, confidence, and control.</p>
                </div>


            </v-container>
        </section>
        <section class="mx-auto" style="max-width: 1400px;">
            <div v-for="value in [1,2,3,4]">
                <div class="d-flex justify-center align-center flex-wrap my-16 ga-16" >
                    <div  class="mt-16">
                        <h2 class="text-lg-h4 text-md-h4 mb-3 ">The Problems Dealers & Traders Face</h2>
                        <h2 class="text-lg-h5 text-md-h4 mb-3 ">1. Bidding Without Knowing the True Market Value</h2>
                        <p class="mb-3">Most traders bid based on guesswork, outdated prices, or limited data. </p>
                        <p class="mb-3">The risk:</p>
                        <ul class="mb-3 ml-5">
                            <li>Overpaying for stock</li>
                            <li>Low or zero profit margins</li>
                            <li>Losing money after fees and repairs</li>
                        </ul>
                    </div>
                    <div><img :src="logoImage" width="100%" alt=""></div>
                </div>
                <div class="d-flex justify-center align-center flex-wrap-reverse my-16 ga-16">
                    <div><img :src="logoImage" width="100%" alt=""></div>
                    <div >
                        <h2 class="text-lg-h4 text-md-h4 mb-3 ">The Problems Dealers & Traders Face</h2>
                        <h2 class="text-lg-h5 text-md-h4 mb-3 ">2. Data Is Scattered Across Too Many Sources</h2>
                        <p class="mb-3">Auction prices, valuations, condition reports, and history all live in different
                            places.</p>
                        <p class="mb-3">The risk:</p>
                        <ul class="mb-3 ml-5">
                            <li>Hours wasted switching platforms</li>
                            <li>Missed opportunities</li>
                            <li>Incomplete decision-making</li>
                        </ul>


                    </div>
                </div>
            </div>
        </section>
    </main>







</template>
<script>
import logoImage from "@/assets/images/logo/mslogo.png"
export default {
    data() {
        return {
            logoImage
        }
    }
}
</script>
<style>
@media (max-width: 442px) {

    .image {
        width: 250px;
    }

}
</style>