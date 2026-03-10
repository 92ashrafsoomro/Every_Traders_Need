<template>
    <div class="mx-auto d-flex bg-surface pt-16 position-relative pa-4" style="
      width:100%;
      border-top: 1px solid rgb(var(--v-theme-border));
      border-radius: 0 200px 0 0;
      overflow: hidden;
      z-index: 1;
    ">
        <!-- Right background image -->
        <div class="position-absolute top-10  right-0  h-100 d-none d-lg-flex d-md-flex" :style="{
            width: '30%',
            backgroundImage: `url(${currentLogo})`,
            backgroundRepeat: 'no-repeat',
            backgroundPosition: 'right center',
            backgroundSize: 'contain',
            opacity: 0.1,
            pointerEvents: 'none'
        }"></div>

        <div class="position-relative mx-auto mt-10" style="max-width: 1400px;">

            <div class="w-100  justify-space-between ">
                <div class="image">
                    <img :src="currentLongLogo" alt="" srcset="" width="150">
                </div>
                <div class=" mt-4">
                    <div class="w-50 pr-10">
                        <p class="text-light_text_on "> Helping dealers, exporters, and traders buy smarter with
                            real-time
                            auction data from across the UK & Japan. Save money, reduce risk,
                            and grow your automotive business all in one platform.
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <div v-for="(section, index) in footerData" :key="index" class="mb-2 ">
                    <div class="d-lg-flex d-md-flex d-none flex-lg-row flex-column">
                        <div class="mt-2  text-body-2 font-weight-bold " style="width: 100px;">{{ section.title }}</div>
                        <div class=" text-light_text_on w-lg-100 w-50">
                            <v-btn v-for="(link, i) in section.links" :key="i" variant="text"
                                class="footerElement mr-lg-2 ml-n4 ml-lg-0 text-body-2" :to="link.to" :href="link.url"
                                :target="link.url ? '_blank' : null">
                                <span class="text-light_text_on"> {{ link.label }}</span>
                            </v-btn>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-10 d-lg-none w-50 pl-4">
                <v-row>
                    <v-col cols="6" v-for="(section, i) in footerData" :key="i">
                        <h4 class="font-weight-bold text-h6 mb-4 text-whiteLite">
                            {{ section.title }}
                        </h4>

                        <div class="d-flex flex-column  ">
                            <v-btn v-for="(link, j) in section.links" :key="j" variant="text"
                                class="text-left justify-start pa-0 footerElement text-body-2 text-light_text_on"
                                :to="link.to" :href="link.url" :target="link.url ? '_blank' : null" rel="noopener"
                                :disabled="link.isdisable" @click.prevent="link.isdisable">
                                {{ link.label }}
                            </v-btn>
                        </div>
                    </v-col>
                </v-row>
            </div>

            <div class="text-light_text_on mt-10    pb-2 text-body-2"
                style="width: 700px; border-top: 1px solid rgb(var(--v-theme-border));">
                <div class="w-50 w-lg-100">
                    <p class="mt-6 mr-2">© AUTOBOLI Ltd 2025. All rights reserved.</p>

                </div>
            </div>
        </div>



    </div>
</template>
<script>
import footerData from "@/enums/WebfooterMenu"
import logoAutoBoli from "@/assets/images/logo/logo.png"
import darkLogo from "@/assets/images/header/darkshort.png"
import lightLogo from "@/assets/images/header/lightshort.png"
import longdarkLogo from "@/assets/images/header/darkfull.png"
import longlightLogo from "@/assets/images/header/lightfull.png"
import { useTheme } from "vuetify"

export default {
    data() {
        return {
            footerData,
            logoAutoBoli,
            currentLogo: lightLogo,
            currentLongLogo: longdarkLogo,
            vuetify: useTheme(),
        }
    },
    computed: {
        isDark() {
            return this.vuetify.global.name === "adminDark"
        }
    },
    watch: {
        // Watch theme changes and update currentLogo
        'vuetify.global.name': {
            immediate: true,
            handler(newTheme) {
                this.currentLogo = newTheme === "adminDark" ? darkLogo : lightLogo
                this.currentLongLogo = newTheme === "adminDark" ? longdarkLogo : longlightLogo

            }
        }
    }
}
</script>

<style scoped>
.footerElement:hover {
    color: white;

}
</style>