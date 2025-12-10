<!-- MissionSection.vue -->
<template>
    <section class="bg-primary ">
        <v-container style="height: 800px;" fluid max-width="1400px"
            class="d-flex justify-content-center align-content-center px-16 py-md-20">
            <v-row no-gutters="" align="center">

                <!-- LEFT: Text Content -->
                <v-col cols="12" lg="6">
                    <div class="pl-0 pl-md-8">
                        <h2 style="" class="text-h2 font-weight-bold  text-white mb-8">
                            {{ data.title }}
                        </h2>

                        <div>
                            <div>
                                <p class="text-h6 mb-6 opacity-90 mr-6 ">
                                    {{ data.highlight }} </p>
                            </div>


                            <p class="text-h6 mb-10 mr-6 opacity-90 ">
                                {{ data.description }}
                            </p>

                        </div>
                    </div>
                </v-col>


                <v-col cols="12" lg="6">

                    <img :src="rightImage" alt="" class="missionImage">

                </v-col>

            </v-row>
        </v-container>
    </section>
</template>

<script>
import missionData from '@/json/mision.json'
import rightImage from '@/assets/images/tabs/mission.png'
export default {
    name: 'MissionSection',
    data() {
        return {
            data: missionData,
            rightImage
        }
    }
}
</script>

<style scoped>
.missionImage {
    width: 100%;
    max-width: 500px;
    border-radius: 12px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    transition: transform 0.35s ease,
        box-shadow 0.35s ease;
}

.missionImage:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(0, 128, 255, 0.3);
}

/* Tablet */
@media (max-width: 960px) {
    .missionImage {
        max-width: 420px;
    }
}

/* Mobile */
@media (max-width: 600px) {
    .missionImage {
        max-width: 320px;
    }
}
</style>