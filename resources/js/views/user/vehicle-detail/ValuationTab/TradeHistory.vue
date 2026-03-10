<template>
    <custom-card class=" flex-grow-1" >
          
            <div cols="12" lg="4" class="d-flex align-center justify-space-between   pa-4">
            <div class="text-h6 font-weight-medium">
                    Trade History
                </div>
                <div>
                <v-select
                    color="primary"
                    variant="outlined"
                    density="compact"
                    label="Select Range"
                    :items="rangeOptions"
                    v-model="selectedRange"
                    @update:model-value="updateRange"
                />
                </div>
            </div>
            
        <v-divider class="mb-4"></v-divider>

        <v-row>
            <v-col cols="12">
                <v-row>
                    <v-col cols="12" lg="12 ">
                        <!-- <div class="d-flex flex-column ga-2 align-start">
                            
                            <p class="text-caption">Avg Winning</p>
                            
                            <div class="mt-3">
                                <p>Compare with win bids</p>
                                
                                <v-checkbox
                                v-for="item in compareOptions"
                                :key="item.key"
                                density="compact"
                                class="text-caption mb-n4"
                                :label="item.label"
                                v-model="compare[item.key]"
                                />
                            </div>
                        </div> -->
                        <div class="position-relative">
    
                            <h1 class="avg-top text-h4 font-weight-bold">
                                £{{ avgWinning }}
                            </h1>
                            <Trade/>
                        </div>
                    </v-col>          
                    </v-row>
                </v-col>
            </v-row>
        </custom-card>
    </template>

<script>
import Trade from './Trade.vue';


export default {
     components: {
        Trade,   // ⬅ MUST ADD THIS
    },
    data() {
        return {
            // RANGE DROPDOWN
            rangeOptions: [
                "Last Month",
                "Last Three Months",
                "Last Six Months",
                "Last Year",
            ],
            selectedRange: "Last Month",

            // MAIN VALUES
            avgWinning: 14000,
            sparkline: [5, 10, 8, 12, 7, 14, 10, 15],

            // CHECKBOXES
            compare: {
                autotrader: false,
                capClean: false,
                capAvg: false,
                capB: false,
            },

            compareOptions: [
                { key: "autotrader", label: "Autotrader" },
                { key: "capClean", label: "CAP Clean" },
                { key: "capAvg", label: "CAP Avg" },
                { key: "capB", label: "CAP B" },
            ],
        };
    },

    methods: {
        updateRange() {
            // dynamic based on selection (local only)
            if (this.selectedRange === "Last Year") {
                this.avgWinning = 18000;
                this.sparkline = [10, 20, 18, 25, 19, 30, 22, 35];
            } else if (this.selectedRange === "Last Six Months") {
                this.avgWinning = 16000;
                this.sparkline = [8, 12, 14, 10, 18, 20, 17];
            } else if (this.selectedRange === "Last Three Months") {
                this.avgWinning = 15000;
                this.sparkline = [6, 8, 12, 11, 15, 17, 13];
            } else {
                this.avgWinning = 14000;
                this.sparkline = [5, 10, 8, 12, 7, 14, 10];
            }
        },
    },
};
</script>

<style scoped>
    .avg-top {
        position: absolute;
        margin-left: 100px;
    }
</style>