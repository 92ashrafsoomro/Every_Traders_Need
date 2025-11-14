<template>
        <div>
            <v-expansion-panels>

                <v-expansion-panel title="Vehicle Type">
                    <v-expansion-panel-text>
                        <VehicleTypeField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                
                <v-expansion-panel :disabled="auctionStore.makes.length ? false : true" title="Make">
                    <v-expansion-panel-text>
                        <MakeField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                
                <v-expansion-panel :disabled="auctionStore.models.length ? false : true" title="Model">
                    <v-expansion-panel-text>
                        <ModelField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                
                <v-expansion-panel :disabled="auctionStore.variants.length ? false : true" title="Model Variant">
                    <v-expansion-panel-text>
                        <VariantField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                
                <v-expansion-panel title="Auction Date">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                
                <v-expansion-panel title="Auction House">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Auction Center">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Years">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Transmission">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Fuel Type">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Doors">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Seats">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Grade">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="V5">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Engine Size (CC)">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Former Keepers">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="No. of Services">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Mileage">
                    <v-expansion-panel-text>
                        <v-checkbox label="Car"></v-checkbox>
                        <v-checkbox label="Light Commercial Vehicle (LCV)"></v-checkbox>
                    </v-expansion-panel-text>
                </v-expansion-panel>
            </v-expansion-panels>
        </div>   
</template>

<script>

import { useAuctionStore } from "@/stores/auctionStore";


import VehicleTypeField from "./fields/VehicleTypeField.vue";
import PlatformField from "./fields/PlatformField.vue";
import MakeField from "./fields/MakeField.vue";
import ModelField from "./fields/ModelField.vue";
import VariantField from "./fields/VariantField.vue";

export default {
    components: {
        PlatformField,
        VehicleTypeField,
        MakeField,
        ModelField,
        VariantField,
    },
    data() {
        return {
            auctionStore:useAuctionStore(),
        };
    },
    computed: {

    },
    methods: {
    
    },
};
</script>

<style scoped>

</style>
