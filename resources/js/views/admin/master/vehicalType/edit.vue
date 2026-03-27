<template>
  <v-container max-width="1400px">
    <v-col cols="12" md="12">
      <v-card class="border " :disabled="loading" >
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">
           Edit Vehicle Type
          </h3>
          <v-btn
            variant="text"
            color="primary"
            to="/admin/vehicalType"
            class="text-capitalize"
            @click="goBack"
          >
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>

        <v-card-text v-if="!loading">
          <v-container fluid>
            <v-row>
              <v-col cols="12">
                <v-row align="center" no-gutters>
                  <v-col cols="3" sm="12" lg="1">
                    <v-text-field
                      v-model="form.id"
                      label="ID"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      readonly
                      class="id-box"
                      persistent-placeholder
                      hide-details
                    />
                  </v-col>
                 <v-col cols="9" sm="12" lg="11" class="pl-2">
                     <v-text-field
                      v-model="form.name"
                      label="Title"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                </v-row>
              </v-col>
              <v-col cols="12" class="mt-3 text-center">
                <v-btn
                  @click="updateBodyType"
                  class="buttonBorder bg-primary"
                  variant="flat"
                  :disabled="loading"
                  style="height: 40px;"
                >
                  <span class="text-capitalize text-body-1 text-white">
                    Update
                  </span>
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-card-text v-else class="text-center">
          Loading...
        </v-card-text>
      </v-card>
    </v-col>
  </v-container>
</template>

<script>
import General from '@/models/general.model';
import VehicleType from '@/models/vehicle-type.model';
import { useVehicalTypeStore } from '@/stores/vehicalTypeStore';
export default {
  data() {
    return {
      vehicalTypeStore : useVehicalTypeStore(),
      form:{
        id: '',
        name: '',
      },
      loading: false,
  };
  },
  async mounted() {
    await this.fetchSingleRecord();
  },
  methods: {
    async fetchSingleRecord() {
    this.loading = true;
    try {
        // const id = this.$route.params.id;
        const res = await this.vehicalTypeStore.getSingleVehical(this.$route.params.id);
        this.form.id = res.id;
        this.form.name = res.name;
    } catch (error) {
      
        this.$alertStore.add(error.message || 'Failed to fetch record', 'error');
    } finally {
        this.loading = false;
    }
    },
    async updateBodyType() {
      this.loading = true;
      try {
        const res = await General.put('/api/cruds/vehicleType/'+this.form.id , this.form);
        console.log(res);
        this.$alertStore.add(res.message || 'Vehicle Type updated', 'success');
        this.loading = false;
        this.$router.push('/admin/vehicleType');
      } catch (error) {
        this.$alertStore.add(error.message || 'Update failed', 'error');
        this.loading = false;
      } finally {
        this.loading = false;
      }
    },
    goBack() {
      this.$router.back();
    },
  },
};
</script>


<style scoped>
.buttonBorder {
  border-radius: 2px;
}

.custom-input :deep(input) {
  text-transform: capitalize;
  font-weight: 500;
}
</style>
