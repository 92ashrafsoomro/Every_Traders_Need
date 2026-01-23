<template>
    <v-container max-width="1400px">
    <v-col cols="12" md="12">
      <v-card class="border">
        <div class="d-flex align-center justify-space-between px-4 py-3">
          <h3 class="text-h6 font-weight-bold">
            Create Task
          </h3>
          <v-btn
            variant="text"
            color="primary"
            class="text-capitalize"
          
          >
            <v-icon start>mdi-arrow-left</v-icon>
            Back
          </v-btn>
        </div>

        <div class="border-b"></div>
      <v-card-text>
  <v-container fluid>
    <v-row>

      <!-- ID -->
        <!-- <v-col cols="12" md="6">
              <v-text-field
                label="ID"
                v-model="form.id"
                readonly
                variant="outlined"
                density="compact"
                hide-details
                class="id-box"
              />
            </v-col> -->

            <!-- Auction Type -->
            <v-col cols="12" md="6">
              <AuctionTypeDropdown
                v-model="form.auction_type"
                label="Auction Type"
                variant="outlined"
                base-color="white"
                density="compact"
              />
            </v-col>

            <!-- Auction House -->
            <v-col cols="12" md="6">
              <PlateformDropdown
                v-model="form.platform"
                label="Auction House"
                variant="outlined"
                base-color="white"
                density="compact"
              />
            </v-col>

            <!-- Auction Name -->
            <v-col cols="12" md="6">
              <v-text-field
                label="Auction Name"
                v-model="form.auction_name"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

            <!-- Auction Date & Time -->
            <v-col cols="12" md="6">
              <v-text-field
                label="Auction Date "
                v-model="form.date"
                type="datetime-local"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>
             <v-col cols="12" md="6">
              <v-text-field
                label="Auction Time"
                v-model="form.created_date"
                type="datetime-local"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

            <!-- Pak Time -->
            <v-col cols="12" md="6">
              <v-text-field
                label="Pak Time"
                v-model="form.pak_time"
                type="time"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

            <!-- Lots -->
            <v-col cols="12" md="6">
              <v-text-field
                label="Lots"
                v-model="form.lots"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                label="Src Lots"
                v-model="form.scr_lots"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

            <v-col>
              <v-text-field
                label="Assign To"
                v-model="form.assign_to"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                label="Final Sheet"
                v-model="form.final_sheet"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

             <v-col cols="12" md="6">
              <v-text-field
                label="Notes"
                v-model="form.notes"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

            <!-- Status -->
            <v-col cols="12" md="6">
              <v-select
                v-model="form.status"
                label="Status"
                :items="['Processing' , 'Not Scrapped' , 'Done']" 
                variant="outlined"
                base-color="white"
                density="compact"
                clearable
              />
            </v-col>

      <!-- Button -->
      <v-col cols="12" class="text-center mt-4">
        <v-btn
          @click="createTask"
          color="primary"
          height="40"
        >
          Update
        </v-btn>
      </v-col>

    </v-row>
  </v-container>
</v-card-text>

          
      </v-card>
    </v-col>
  </v-container>
</template>

<script>
import AuctionTypeDropdown from '@/components/AuctionTypeDropdown.vue';
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import StatusDropdown from '@/components/StatusDropdown.vue';
import General from '@/models/general.model';

export default {
    components:{
        AuctionTypeDropdown,
        PlateformDropdown,
        StatusDropdown
    },
    data(){
        return{
             form:{
                id : '',
                auction_type : "",
                platform : "",
                auction_name : "",
                date : "",
                created_date : "",
                pak_time : "",
                lots : "",
                scr_lots : '',
                assign_to : '',
                final_sheet: '',
                status : null,
                notes : ""
            },
            loading : false
        }
    },
 
    methods:{
        async createTask(){
            this.loading = true;
            try {
               const res = await General.post('/api/cruds/taskManagement', this.form)
               this.$alertStore.add(res.message, 'success');
                 this.$router.push('/admin/taskManagement')

            } catch (error) {
                this.$alertStore.add(error.message || 'Some Thing went wrong' , error)
            }finally {
                this.loading = false;
            }
        }
    }
    
}
</script>