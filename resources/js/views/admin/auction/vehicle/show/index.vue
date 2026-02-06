<template>
  <v-app>
      <user-title-bar>
        <div>
            <h1 class="text-h3 mb-2 font-weight-bold">{{ vehicle.title }}</h1>
            <p class="text-subtitle-1 mb-2 font-weight-medium">Created by <span class="text-primary"> {{ vehicle.created_by ?? "Muhammad Shakeeb Raza" }} </span></p>

            <div class="d-flex mt-6  ga-3">

            <v-tabs v-model="tab" bg-color="transparent" color="primary">
            <v-tab value="vehicle">VEHICLE</v-tab>
            <v-tab value="specifications">Specifications</v-tab>
            <v-tab value="Servicehistory">Service History & Pricings</v-tab>
            <v-tab value="condition">Condition</v-tab>
            <v-tab value="additionalinformation">Additional information</v-tab>
          </v-tabs>

            </div>
        </div>
    </user-title-bar>
    <v-container fluid class="pa-6">
      <v-row>
        
  
 
        <v-col cols="12" md="12">
     

          <v-divider class="mb-4"></v-divider>


          <v-window v-model="tab">

            <Vehicledetail :vehicle="vehicle" :images="images" />
            <Specifications :vehicle="vehicle" />
            <Servicehistory :vehicle="vehicle" />
            <Condition :vehicle="vehicle" :images="damaged_images" :damage_details="damage_details" />
            <Additionalinformation :vehicle="vehicle" />
            
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
import Additionalinformation from './additionalinformation.vue';
import Condition from './condition.vue';
import Auction from "@/models/auction.model";
export default {
  components: {
    Vehicledetail,
    Specifications,
    Servicehistory,
    Condition,
    Additionalinformation
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
        const id = this.$route.params.id
        const reg = this.$route.query.reg   

        const res = await Auction.getScrapSingle(id, {
          reg: reg
        })

        const vehicle = res.data[0]

        this.images = vehicle.images
          ? vehicle.images.split(',').map(i => i.trim())
          : []

        this.damaged_images = vehicle.damaged_images
          ? vehicle.damaged_images.split(',').map(i => i.trim())
          : []

        this.damage_details = vehicle.damage_details
          ? vehicle.damage_details.split(',').map(item => {
              const parts = item.split('|').map(p => p.trim())
              return {
                key: parts[0],
                value: parts.slice(1).join(' ')
              }
            })
          : []

        this.vehicle = vehicle

      } catch (error) {
        this.$alertStore.add(error.message || 'Failed to fetch record', 'error')
      } finally {
        this.loading = false
      }
    }

  },
};
</script>





