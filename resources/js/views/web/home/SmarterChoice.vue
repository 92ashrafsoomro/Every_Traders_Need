<template>
    <div class="mx-auto  d-flex align-center justify-center mt-lg-0 mt-16" style="max-width: 1400px; min-height: 800px; ">
        <div>
            <div class="text-center pa-3 ">

                <h2 class="text-h4 text-md-h3 font-weight-bold text-whiteLite mb-4"> Turning auction data into smarter buying decisions
                </h2>
                <p class="text-subtitle-1 text-light_text_on mx-auto" style="max-width:800px">Autoboli helps UK dealers
                    and traders cut through auction noise and turn raw data into clear, confident decisions — every
                    single day.</p>
            </div>
            <div class="d-flex w-100 flex-column flex-md-row flex-lg-row
         ga-4 mt-10
         align-center align-md-start">

                <div v-for="(item, i) in smartData" :key="i" cols="12" md="4" class="h-75 w-75 text-center">
                    <div rounded="xl" class="pa-8">
                        <!-- ICON -->
                        <div class="mb-6 d-flex align-center justify-center mx-auto" style="width:100px; height:100px;">
                            <img :src="item.icon" alt="icon" style="max-width:100%;"/>
                        </div>


                        <!-- TITLE -->
                        <h4 class="text-lg-h3 text-md-h4 text-h5 font-weight-bold ">
                            {{ item.title }}
                        </h4>

                        <!-- DESCRIPTION -->
                        <p class="text-lg-h6 text-body-2 mt-3 text-medium-emphasis">
                            {{ item.description }}
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
import image1 from "@/assets/images/icons/Asset 8.png"
import image2 from "@/assets/images/icons/Asset 11.png"
import image3 from "@/assets/images/icons/Asset 12.png"
export default {
    data() {
        return {
            smartData: [
                {
                    title: "30+",
                    description: "auction houses",
                    icon: image1
                },
                {
                    title: "Millions+",
                    description: "vehicle records analyzed",
                    icon:image2,
                },
                {
                    title: "10,000+",
                    description: "daily auction lots tracked",
                    icon:image3
                }]
        }
    }
}

</script>