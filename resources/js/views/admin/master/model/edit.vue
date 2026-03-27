<template>
  <v-container max-width="1400px">
    <v-col cols="12" md="12">
      <v-card class="border">
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">
           Edit Model
          </h3>
          <v-btn
            variant="text"
            color="primary"
            to="/admin/model"
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
                  <v-col cols="12" md="4" lg="4" sm="12">
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
                  <v-col cols="12" md="4" lg="4" sm="12" class="pl-lg-2 pl-md-2 mt-lg-0 mt-md-0 mt-2">
                      <MakeDropdown 
                        label="Select Make"
                  variant="outlined"
                  item-title="name"
                  item-value="id"
                  v-model="form.make_id"  
                  color="primary"
                  density="compact"
                  hide-details />
                  </v-col>
                  <v-col cols="12" md="4" lg="4" sm="12" class="pl-lg-2 pl-md-2 mt-lg-0 mt-md-0 mt-2">
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
                  style="height: 40px;"
                  :disabled="loading"
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
import Model from '@/models/vehicle-model.model';
import { useModelStore } from '@/stores/modelStore';
import MakeDropdown from "@components/MakeDropdown.vue"

export default {
    components:{
    MakeDropdown,
  },
  data() {
    return {
      modelStore : useModelStore(),
      form:{
        id: '',
        name: '',
        make_id:"",
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
        const data = await this.modelStore.getSingleVariant(this.form.id);
        this.form.make_id = data.make_id;
        this.form.id = data.id;
        this.form.name = data.name;
    } catch (error) {
      
        this.$alertStore.add(error.message || 'Failed to fetch record', 'error');
    } finally {
        this.loading = false;
    }
    },
    async updateBodyType() {
      this.loading = true;
      try {
        if (!this.form.id) {
          this.$alertStore.add('Id not found' , 'error');
          return false
        }      
        const res = await General.put("/api/cruds/model/"+this.form.id , this.form);
        this.$alertStore.add(res.message || 'Model updated', 'success');
        this.loading = false;
        this.$router.push('/admin/model');
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
