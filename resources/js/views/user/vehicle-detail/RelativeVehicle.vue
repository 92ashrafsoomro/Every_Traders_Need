<template>
    <v-card color="transparent" flat class="h-100">
            <v-row class="space-between ps-2 pe-2">
                <v-col cols="4">
                    <div class="text-overline mb-2">Filters</div>
                </v-col>
                <v-col cols="4">
                    <v-btn size="small" color="primary">{{ data.length }}</v-btn>
                </v-col>
                <v-col cols="4"> 
                    <v-btn> Clear All </v-btn>
                </v-col>
            </v-row>
            <v-row class="ps-2 pe-2">
                <v-col cols="6">
                    <v-select color="primary" label="All" density="compact" variant="outlined"></v-select>
                </v-col>
                <v-col cols="6">
                    <v-select v-if="vehicleStore.platforms"
                       :items="vehicleStore.platforms" 
                       v-model="filters.platform"
                       @update:model-value="loadRelativeVehichle"
                       item-title="label" 
                       item-value="id" 
                       color="primary" 
                       label="Select Platform" 
                       density="compact" 
                       variant="outlined"
                       clearable="" />
                </v-col>
            </v-row>
            <v-expansion-panels class="overflow-y-auto" style="max-height: 79vh;">
                <v-expansion-panel v-for="item in data" :key="item.id">
                    <v-expansion-panel-title class="rounded-0">
                        <div class="d-flex align-center w-100">
                            <img src="https://www1.bcaimage.com/Document?DocType=VehicleImage&width=300&docId=613522131" class="rounded mr-3 object-fit" width="50px" height="50px" />
                            <div class="flex-grow-1">
                                <div class="text-subtitle-1 font-weight-medium">{{ item.make_name }} {{ item.model_name }} {{ item.variant_name }}</div>
                                <div class="text-body-2 text-grey-lighten-1">{{ item.price_symbol }}{{ item.price }}</div>
                            </div>
                        </div>
                    </v-expansion-panel-title>
                    <v-expansion-panel-text>
                        <v-btn :to="'/user/vehicle-detail/'+item.id" density="comfortable" variant="outlined" color="primary">{{ item.platform_name }}</v-btn>
                        <div class="d-flex justify-normal align-center ga-2 mt-2">
                            <p>{{ item.date }}</p>
                            <p>{{ item.center_name }}</p>
                        </div>
                    </v-expansion-panel-text>
                </v-expansion-panel>
            </v-expansion-panels>
    </v-card>
</template>

<script>
import { useVehicleStore } from '@/stores/vehicleStore';


export default {
    components: {
 
    },
    data() {
        return {
            filters: {
                platform:null,
                id:'',
            },
            
            items:[],
            data:[],
            loading:false,
            vehicleStore:useVehicleStore(),
        };
    },
    mounted() {

        this.loadRelativeVehichle();
        this.vehicleStore.getPlatforms({});

        // this.items = this.vehicleStore.platforms;

    },
    beforeUnmount() {
        
    },
    methods: {
        loadRelativeVehichle() {  

            this.loading = true;
            this.filters.id = this.$route.params.id;

            this.vehicleStore.getRelatedVehicle(this.filters).then((res) => {
                this.data = res.data;
                    this.loading = false;
            }).catch(() => {
                    this.loading = false;

            });
        },
      

        
        
     
    },
};
</script>

<style scoped>
    /* Vuetify’s internal wrapper override */
    ::-webkit-scrollbar {
        display: none;
    }

    .mobile-panel {
        max-width: 280px;
    }
</style>