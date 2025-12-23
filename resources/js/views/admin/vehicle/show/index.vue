<template>
  <v-app>
    <v-container fluid class="pa-6">
      <v-row>
        

 
        <v-col cols="12" md="12">
          <v-tabs v-model="tab" bg-color="transparent" color="primary">
            <v-tab value="vehicle">VEHICLE</v-tab>
            <v-tab value="specifications">Specifications</v-tab>
            <v-tab value="Servicehistory">Service History & Pricings</v-tab>
            <v-tab value="condition">Condition</v-tab>
            <v-tab value="additionalinformation">Additional information</v-tab>
          </v-tabs>

          <v-divider class="mb-4"></v-divider>


          <v-window v-model="tab">

            <Vehicledetail :vehicle="vehicle" :images="images" />
            <Specifications :vehicle="vehicle" />
            <Servicehistory :vehicle="vehicle" />
            <Condition :vehicle="vehicle" :images="damaged_images" :damage_details="damage_details" />

            <v-window-item value="Pricings">
              <p class="text-center pa-10">Damage report content</p>
            </v-window-item>
          </v-window>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import VehicleDetail from '@/models/getvehicledetail.model';

import Vehicledetail from './Vehicledetail.vue';
import Specifications from './specifications.vue';
import Servicehistory from './Servicehistory.vue';
import Condition from './condition.vue';
export default {
  components: {
    Vehicledetail,
    Specifications,
    Servicehistory,
    Condition
  },

  data() {
    return {
      tab: 'vehicle',
      loading: false,
      vehicle: {},
      images: [],   
      damaged_images: [],   
      damage_details: [],   
    };
  },

  async mounted() {
    await this.fetchRecord();
  },

  methods: {
    async fetchRecord() {
      this.loading = true;
      try {
        const id = this.$route.params.id;
        const res = await VehicleDetail.get(id);
        console.log(res.data.vehicle);
        if (res.data.vehicle.images) {
            let stringvalue = res.data.vehicle.images.split(',').map(img => img.trim());
            this.images = stringvalue
        }else{
            this.images = []
        }
        if (res.data.vehicle.damaged_images) {
            let stringvalue = res.data.vehicle.damaged_images.split(',').map(img => img.trim());
            this.damaged_images = stringvalue
        }else{
            this.damaged_images = []
        }
        if (res.data.vehicle.damage_details) {
          this.damage_details = res.data.vehicle.damage_details
            .split(',')
            .map(item => {
              const parts = item.split('|').map(p => p.trim());
              return {
                key: parts[0],
                value: parts.slice(1).join(' ')
              };
            });
        } else {
          this.damage_details = [];
        }

         
        this.vehicle = res.data.vehicle;
      } catch (error) {
        this.$alertStore.add(
          error.message || 'Failed to fetch record',
          'error'
        );
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>





