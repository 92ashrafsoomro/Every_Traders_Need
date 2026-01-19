<template>
  <v-container max-width="1400px">
    <v-col cols="12" md="12">
      <v-card class="border">
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">
           Edit Make
          </h3>
          <v-btn
            variant="text"
            color="primary"
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
                  <v-col cols="1" sm="3">
                    <v-text-field
                      v-model="form.id"
                      label="ID"
                      variant="outlined"
                      density="compact"
                      disabled=""
                      color="primary"
                      readonly
                      class="id-box"
                      persistent-placeholder
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" class="pl-2">
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
import Make from '@/models/make.model';
import { useMakeStore } from '@/stores/makeStore';
export default {
  data() {
    return {
      makeStore : useMakeStore(),
      form:{
        id: '',
        name: null,
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
        const res = await this.makeStore.getSingleMake(this.form.id);
        console.log('Make', res);
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
        if(!this.form.name){
          this.$alertStore.add('Name not found' , 'error');
          return false
        }
        const res = await General.put("/api/cruds/make/" + this.form.id , this.form);
        console.log(res);
        
        this.$alertStore.add(res.message || 'Make updated', 'success');
        this.$router.push('/admin/make');
      } catch (error) {
        this.$alertStore.add(error.message || 'Update failed', 'error');
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
