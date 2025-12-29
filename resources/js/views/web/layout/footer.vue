<template>
    <div class="mx-auto d-flex bg-surface pt-16 position-relative pa-4" style="
      width:100%;
      border-top: 1px solid rgb(var(--v-theme-border));
      border-radius: 0 300px 0 0;
      overflow: hidden;
      z-index: 1;
    ">
        <!-- Right background image -->
        <div class="position-absolute top-10  right-0  h-100 d-none d-lg-flex d-md-flex" :style="{
            width: '30%',
            backgroundImage: `url(${logo})`,
            backgroundRepeat: 'no-repeat',
            backgroundPosition: 'right center',
            backgroundSize: 'contain',
            opacity: 0.1,
            pointerEvents: 'none'
        }"></div>

        <div class="position-relative mx-auto mt-10" style="max-width: 1400px;">

            <div class="w-100  justify-space-between">
                <div class="image">
                    <img :src="logoAutoBoli" alt="" srcset="" width="150">
                </div>
                <div class="left mt-4">
                    <p class="text-light_text_on w-25 w-lg-50 w-md-50"> Helping dealers, exporters, and traders buy smarter with real-time
                        auction data from across the UK & Japan. Save money, reduce risk,
                        and grow your automotive business <br> all in one platform.
                    </p>
                </div>
            </div>
            <div class="mt-10">
                <div v-for="(section, index) in footerData" :key="index" class="mb-2 ">
                    <div class="d-flex flex-wrap">
                        <div class="mt-2  text-body-2 " style="width: 100px;">{{ section.title }}</div>
                        <div class=" text-light_text_on ">
                            <v-btn v-for="(link, i) in section.links" :key="i" variant="text" class="footerElement mr-2 text-body-2"
                                :to="link.to" :href="link.url" :target="link.url ? '_blank' : null">
                                {{ link.label }}
                            </v-btn>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="text-light_text_on mt-10    pb-2 text-body-2" style="width: 700px; border-top: 1px solid rgb(var(--v-theme-border));">
                <p class="mt-6" >© AUTOBOLI Ltd 2025. All rights reserved.</p>
                <p>
                    Proudly built & hosted with secure infrastructure in the UK & EU.
                </p>
            </div>
        </div>



    </div>
</template>

<script>
import logo from '@/assets/images/logo/newlogo.png'
import footerData from "@/enums/WebfooterMenu"
import logoAutoBoli from "@/assets/images/logo/logo.png"
export default {

    data() {
        return {
            footerRightImage: '',
            footerData,
            logo,
            logoAutoBoli
        }
    }
}
</script>

<style scoped>
    .footerElement:hover{
        color: white;

    }
</style>