<template>
    <v-container fluid class="pa-0" style="min-height: 100vh;">
        <v-row dense>
            <!-- Left Filter Panel - Fixed -->
            <v-col class="bg-transparent border-e pt-5 mt-2 fixed-col" cols="12" md="2">
                <v-card color="transparent" flat class="h-100">
                    <v-row justify="space-between ps-2 pe-2">
                        <v-col cols="4">
                            <div class="text-overline mb-2">Filters</div>
                        </v-col>
                        <v-col cols="4">
                            <v-btn size="small" color="primary"> 18</v-btn>
                        </v-col>
                        <v-col cols="4">
                            Clear All
                        </v-col>
                    </v-row>
                    <v-row class="ps-2 pe-2">
                        <v-col cols="6">
                            <v-select color="primary" label="All" density="compact" variant="outlined"></v-select>
                        </v-col>
                        <v-col cols="6">
                            <v-select color="primary" label="Select Platform" density="compact"
                                variant="outlined"></v-select>
                        </v-col>
                    </v-row>
                    <v-expansion-panels>
                        <v-expansion-panel v-for="n in 20" :key="n">
                            <v-expansion-panel-title class="rounded-0">
                                <div class="d-flex align-center w-100">
                                    <img src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=300&docId=613522131"
                                        class="rounded mr-3 object-fit" width="50px" height="50px" />

                                    <div class="flex-grow-1">
                                        <div class="text-subtitle-1 font-weight-medium">BMW 3 Series</div>
                                        <div class="text-body-2 text-grey-lighten-1">£18,900</div>
                                    </div>
                                </div>
                            </v-expansion-panel-title>

                            <v-expansion-panel-text>
                                <v-btn density="comfortable" variant="outlined" color="primary">
                                    Auction House
                                </v-btn>
                                <div class="d-flex justify-normal align-center ga-2 mt-2">
                                    <p>11-11-2025</p>
                                    <p>Leeds</p>
                                </div>
                            </v-expansion-panel-text>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-card>
            </v-col>

            <!-- Spacer Column (invisible, prevents overlap) -->
            <v-col cols="12" md="2" class="d-none d-md-block pa-10"></v-col>

            <!-- Middle Section -->
            <v-col cols="12" md="7" class="pa-5">
                <v-row dense>
                    <!-- Tabs -->
                    <v-col cols="12">
                        <v-btn-toggle class="w-100" color="primary" mandatory>
                            <v-btn>Vehicle Details</v-btn>
                            <v-btn>Vehicle Valuation</v-btn>
                        </v-btn-toggle>
                    </v-col>

                    <!-- Autoboli Suggestion -->
                    <v-col cols="12">
                        <v-card class="pa-4 bg-blue-darken-3 rounded-xl">
                            <div class="text-h6 font-weight-bold mb-2">AUTOBOLI SUGGESTION</div>
                            <div class="text-h4">£14,000</div>
                        </v-card>
                    </v-col>

                    <!-- Vehicle Values -->
                    <v-col cols="12">
                        <v-card class="pa-4 bg-grey-darken-3 rounded-xl">
                            <div class="text-h6 mb-2">Vehicle Values</div>
                            <v-row>
                                <v-col cols="6">Trade Values</v-col>
                                <v-col cols="6">Retail Values</v-col>
                            </v-row>
                        </v-card>
                    </v-col>

                    <!-- Vehicle Info -->
                    <v-col cols="12">
                        <v-card class="pa-4 bg-grey-darken-3 rounded-xl">
                            <div class="text-h6 mb-3">Vehicle Information</div>
                            <v-img
                                src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=600&docId=613522131"
                                aspect-ratio="16/9" class="rounded-lg" />
                        </v-card>
                    </v-col>
                </v-row>
            </v-col>

            <!-- Right Side Summary -->
            <v-col cols="12" md="3">
                <v-card class="pa-4 mb-4 bg-grey-darken-3 rounded-xl">
                    <div class="text-h6 mb-2">Autoboli Predicted</div>
                    <v-progress-linear model-value="90" height="10" color="blue" rounded></v-progress-linear>
                </v-card>

                <v-card class="pa-4 bg-grey-darken-3 rounded-xl">
                    <div class="text-h6 mb-2">Auction Results</div>
                    <div>Auction Status: Sold</div>
                    <div>Win Bid: £13,150</div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { useThemeStore } from "@/stores/themeStore";

export default {
    data() {
        return {
            themeStore: useThemeStore(),
        };
    },
    mounted() {
        this.themeStore.menuType = "collapsed";
    },
};
</script>

<style scoped>
.fixed-col {
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    top: 5;

    z-index: 100;
}

/* Optional: Add custom scrollbar styling */
.fixed-col::-webkit-scrollbar {
    width: 8px;
}

.fixed-col::-webkit-scrollbar-track {
    background: transparent;
}

.fixed-col::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.fixed-col::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>