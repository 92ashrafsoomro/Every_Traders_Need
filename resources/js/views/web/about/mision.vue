<!-- MissionSection.vue -->
<template>
    <section class="bg-surface ">
        <v-container fluid max-width="1400px" class="px-0 py-16 py-md-20">
            <v-row no-gutters="" align="center" >

                <!-- LEFT: Text Content -->
                <v-col cols="12" lg="6">
                    <div class="pl-0 pl-md-8">
                        <h2 class="text-h3  text-white mb-8">
                            {{ data.title }}
                        </h2>

                        <div class="">
                        

                            <div style="border-left: 6px solid white;" >
                                   <p class="text-body-1 text-grey-lighten-1 mb-10 opacity-90 ml-4 ">
                                {{ data.highlight }} </p>
                            </div>
                         

                            <p class="text-body-1 text-grey-lighten-1 mb-10 mr-10 opacity-90 ">
                                {{ data.description }}
                            </p>

                            <v-btn variant="tonal" size="large" class="px-8 text-capitalize bg-white">
                                {{ data.buttonText }}
                            </v-btn>
                        </div>
                    </div>
                </v-col>


                <v-col cols="12" lg="6">
                    <div class="missionVissionBoxDiv position-relative ms-auto" style="max-width: 520px; height: 560px;">

                        <!-- Big White Card -->
                        <v-card class="position-absolute card border-0" elevation="24" rounded="xl"
                            color="grey-lighten-4" style="top: 80px; right: 40px; width: 480px; height: 320px;" />

                        <!-- Top Right Blue Card -->
                        <v-card class="position-absolute cardRightDiv" color="primary" rounded="xl" elevation="20"
                            style="top: 130px; right: 0; width: 160px; height: 120px;">
                            <v-responsive :aspect-ratio="4 / 3" />
                        </v-card>

                        <!-- Bottom Left Blue Card -->
                        <v-card class="position-absolute cardLeftDiv" color="primary" rounded="xl" elevation="20"
                            style="bottom: 90px; left: -50px;  width: 180px; height: 140px;">
                            <v-responsive :aspect-ratio="9 / 7" />
                        </v-card>

                    </div>
                </v-col>

            </v-row>
        </v-container>
    </section>
</template>

<script>
import missionData from '@/json/mision.json'

export default {
    name: 'MissionSection',
    data() {
        return {
            data: missionData
        }
    }
}
</script>


<style scoped>
/* Float animations can be kept if needed */
@media (max-width: 960px) {

    /* Big White Card */

}

@media (max-width : 600px) {
  

   
}
</style>
