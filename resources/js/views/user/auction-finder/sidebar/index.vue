<template>
        <div>
            <v-expansion-panels>

                <v-expansion-panel :disabled="masterStore.vehicleTypes.data.length ? false : true" title="Vehicle Type">
                    <v-expansion-panel-text>
                        <VehicleTypeField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                
                <v-expansion-panel :disabled="masterStore.makes.data.length ? false : true" title="Make">
                    <v-expansion-panel-text>
                        <MakeField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                
                <v-expansion-panel :disabled="masterStore.models.data.length ? false : true" title="Model">
                    <v-expansion-panel-text>
                        <ModelField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                
                <v-expansion-panel :disabled="masterStore.variants.data.length ? false : true" title="Model Variant">
                    <v-expansion-panel-text>
                        <VariantField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>

                <v-expansion-panel :disabled="masterStore.platforms.data.length ? false : true" title="Auction House">
                    <v-expansion-panel-text>
                        <PlatformField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>

                <v-expansion-panel :disabled="masterStore.centers.data.length ? false : true" title="Auction Center">
                    <v-expansion-panel-text>
                        <CenterField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>
                

                <v-expansion-panel :disabled="masterStore.years.data.length ? false : true" title="Years">
                    <v-expansion-panel-text>
                          <YearField/>
                    </v-expansion-panel-text>
                </v-expansion-panel>

                <v-expansion-panel title="Transmission" :disabled="masterStore.transmissions.data.length ? false : true">
                    <v-expansion-panel-text>
                       <TransmissionField />
                    </v-expansion-panel-text>
                </v-expansion-panel>

                <v-expansion-panel :disabled="masterStore.fuelType.data.length ? false : true" title="Fuel Type">
                    <v-expansion-panel-text>
                        <FuelTypeField />
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel :disabled="masterStore.doors.data.length ? false : true" title="Doors">
                    <v-expansion-panel-text>
                         <DoorField />
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel :disabled="masterStore.seats.data.length ? false : true" title="Seats">
                    <v-expansion-panel-text>
                         <SeatField />
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel :disabled="masterStore.grades.data.length ? false : true" title="Grade">
                    <v-expansion-panel-text>
                      <GradeField />
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel :disabled="masterStore.v5.data.length ? false : true" title="V5">
                    <v-expansion-panel-text>
                        <V5Field />
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel :disabled="masterStore.cc.data.length ? false : true" title="Engine Size (CC)">
                    <v-expansion-panel-text>
                       <CCField />
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel :disabled="masterStore.formerKeepers.data.length ? false : true" title="Former Keepers">
                    <v-expansion-panel-text>
                        <FormerKeeperField />
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel :disabled="masterStore.noOfServices.data.length ? false : true" title="No. of Services">
                    <v-expansion-panel-text>
                      <NoOfServices />
                    </v-expansion-panel-text>
                </v-expansion-panel>
                <v-expansion-panel title="Mileage">
                    <v-expansion-panel-text>
                       <MilegueField />
                    </v-expansion-panel-text>
                </v-expansion-panel>
            </v-expansion-panels>
        </div>   
</template>

<script>

import { useAuctionStore } from "@/stores/auctionStore";
import { useMasterStore } from "@/stores/masterStore";


import VehicleTypeField from "./fields/VehicleTypeField.vue";
import PlatformField from "./fields/PlatformField.vue";
import MakeField from "./fields/MakeField.vue";
import ModelField from "./fields/ModelField.vue";
import VariantField from "./fields/VariantField.vue";
import CenterField from "./fields/CenterField.vue";
import YearField from "./fields/YearField.vue";
import TransmissionField from "./fields/TransmissionField.vue";
import FuelTypeField from "./fields/FuelTypeField.vue";
import DoorField from "./fields/DoorField.vue";
import SeatField from "./fields/SeatField.vue";
import GradeField from "./fields/GradeField.vue";
import V5Field from "./fields/V5Field.vue";
import CCField from "./fields/CCField.vue";
import FormerKeeperField from "./fields/FormerKeeperField.vue";
import NoOfServices from "./fields/NoOfServices.vue";
import MilegueField from "./fields/MilegueField.vue";

export default {
    components: {
        PlatformField,
        VehicleTypeField,
        MakeField,
        ModelField,
        VariantField,
        CenterField,
        YearField,
        TransmissionField,
        FuelTypeField,
        DoorField,
        SeatField,
        GradeField,
        V5Field,
        CCField,
        FormerKeeperField,
        NoOfServices,
        MilegueField,
    },
    data() {
        return {
            auctionStore: useAuctionStore(),
            masterStore:useMasterStore(),
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
