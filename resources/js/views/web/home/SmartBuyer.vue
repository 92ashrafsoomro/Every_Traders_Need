<template>
    <div class="mx-auto" style="max-width: 1400px; ">
        <div class="text-center">

            <h3 class="text-h3 font-weight-bold"> Why smart car buyers start with carVertical</h3>
            <p class="text-h6 mt-4">A carVertical vehicle history report is your first step to knowing what’s worth your
                money, <br> what’s worth
                your time, and what makes the best final choice.</p>
        </div>
        <v-container style="max-width:1400px">
            <v-row justify="center" class="mt-12">

                <v-col v-for="(item, i) in smartData" :key="i" cols="12" md="4" class="text-center">
                    <v-sheet rounded="xl" class="pa-8 h-100" elevation="0">
                        <!-- ICON -->
                        <div v-html="item.icon" class="mb-6 d-flex justify-center"></div>

                        <!-- TITLE -->
                        <h4 class="text-h6 font-weight-bold mb-4">
                            {{ item.title }}
                        </h4>

                        <!-- DESCRIPTION -->
                        <p class="text-body-2 text-medium-emphasis">
                            {{ item.description }}
                        </p>
                    </v-sheet>

                </v-col>

            </v-row>
        </v-container>

    </div>
</template>

<script>
export default {
    data() {
        return {
            smartData: [
                {
                    title: " Avoid expensive mistakes",
                    description: "Spot past damage, mileage rollbacks, or other costly issues early – and walk away from money pits that could cost you thousands later.",
                     icon: ``
                },
                {
                    title: "  Find the right car faster",
                    description: "Avoid pointless test drives by checking the facts online and only inspecting the cars that are actually worth your time."
                },
                {
                    title: "  Know more, pay less",
                    description: "Learn the car's story, know more than the seller expects, and use the facts to get a better price."
                }]
        }
    }
}

</script>