<template>
 <v-container max-width="1400px">
    <v-col cols="12" md="12">
      <v-card class="border">
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">
            Edit
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
                  <v-col cols="6" sm="3" lg="6">
                    <v-text-field
                      label="ID"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      v-model="form.id"
                      readonly
                      class="id-box"
                      persistent-placeholder
                      hide-details
                    />
                  </v-col>
                  <v-col cols="6" sm="9" lg="6" class="pl-2">
                    <v-text-field
                      label="Auction Type"
                      variant="outlined"
                      density="compact"
                      v-model="form.auction_type"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4 ">
                    <v-text-field
                      label="Platform"
                      variant="outlined"
                      density="compact"
                      v-model="form.platform"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4  pl-2">
                    <v-text-field
                      label="Auction Name"
                      variant="outlined"
                      density="compact"
                      v-model="form.auction_name"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4 ">
                    <v-text-field
                      label="Auction Date"
                      variant="outlined"
                      v-model="form.date"
                      density="compact"
                      type="date"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4 pl-2">
                    <v-text-field
                      label="Auction Time"
                      variant="outlined"
                      v-model="form.created_date"
                      density="compact"
                      color="primary"
                      type="time"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4 ">
                    <v-text-field
                      label="Pak Time"
                      variant="outlined"
                      density="compact"
                      type="time"
                      color="primary"
                      v-model="form.pak_time"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4 pl-2">
                    <v-text-field
                      label="Lots"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      v-model="form.lots"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4 ">
                    <v-text-field
                      label="Src Lots"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      clearable
                      v-model="form.src_lots"
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4 pl-2">
                    <v-text-field
                      label="Status"
                      variant="outlined"
                      density="compact"
                      v-model="form.status"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <!-- <v-col cols="11" sm="9" lg="6" class="mt-4 ">
                    <v-text-field
                      label="Assigned"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col> -->
                  <!-- <v-col cols="11" sm="9" lg="6" class="mt-4 pl-2">
                    <v-text-field
                      label="Auction Type"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col>
                  <v-col cols="11" sm="9" lg="6" class="mt-4 ">
                    <v-text-field
                      label="Auction Type"
                      variant="outlined"
                      density="compact"
                      color="primary"
                      clearable
                      persistent-placeholder
                      class="custom-input"
                      hide-details
                    />
                  </v-col> -->
                </v-row>
              </v-col>
              <v-col cols="12" class="mt-3 text-center">
                <v-btn
                 
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
import { useTaskManagementStore } from './store/taskManagementStore';

export default {
    data(){
        return{
          taskManagementStore : useTaskManagementStore(),
            form:{
                id : '',
                auction_type : "",
                platform : "",
                auction_name : "",
                date : "",
                created_date : "",
                pak_time : "",
                lots : "",
                src_lots : "",
                status : '',
            },
            loading: false
        }
    },
    async mounted(){
        await this.fetchSignleRecord()
    },
    methods:{
        async fetchSignleRecord(){
            this.loading = true;

            try{
                const res = await this.taskManagementStore.getTaskManagement(this.$route.params.id);
                const data = res[0];
                this.form.id = data.id
            
                
            }catch (error) {
                this.$alertStore.add(error.message || 'Failed to fetch record', 'error');
            } finally {
                this.loading = false;
            }
        }
    }
}
    
</script>