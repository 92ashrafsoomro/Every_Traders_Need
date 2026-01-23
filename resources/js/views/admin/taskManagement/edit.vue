<template>
 <v-container max-width="1400px">
  <v-col cols="12">
    <v-card class="border">

      <!-- Header -->
      <div class="d-flex align-center justify-space-between px-4 py-3">
        <h3 class="text-h6 font-weight-bold">Edit</h3>
        <v-btn variant="text" color="primary" class="text-capitalize">
          <v-icon start>mdi-arrow-left</v-icon>
          Back
        </v-btn>
      </div>

      <div class="border-b"></div>

      <!-- Form -->
      <v-container fluid>
    <v-row>

      <!-- ID -->
        <v-col cols="12" md="6">
              <v-text-field
                label="ID"
                v-model="form.id"
                readonly
                variant="outlined"
                density="compact"
                hide-details
                class="id-box"
              />
            </v-col>

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
                label="Auction Date & Time"
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
                label="End Time "
                v-model="form.end_time"
                type="datetime-local"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col>

            <!-- Pak Time -->
            <!-- <v-col cols="12" md="6">
              <v-text-field
                label="Pak Time"
                v-model="form.pak_time"
                type="time"
                variant="outlined"
                density="compact"
                clearable
                hide-details
              />
            </v-col> -->

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
                :items="taskManagementStore.status"
                item-title="title"
                 item-value="value"  
                variant="outlined"
                density="compact"
                clearable
               />

            </v-col>

      <!-- Button -->
      <v-col cols="12" class="text-center mt-4">
        <v-btn
          @click="updateData"
          color="primary"
          height="40"
        >
          Update
        </v-btn>
      </v-col>

    </v-row>
  </v-container>

    </v-card>
  </v-col>
</v-container>

</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import { useTaskManagementStore } from '@/stores/taskManagementStore';
import AuctionTypeDropdown from '@/components/AuctionTypeDropdown.vue';
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
          taskManagementStore : useTaskManagementStore(),
            form:{
                id : '',
                auction_type : null,
                platform : null,
                auction_name : "",
                date : "",
                // created_date : "",
                // pak_time : "",
                lots : "",
                // scr_lots : '',
                assign_to : '',
                end_time : '',
                final_sheet: '',
                status : null,
                notes : ''
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
                const res = await this.taskManagementStore.editTaskData(this.$route.params.id);
                this.form.id = res.id;
                this.form.auction_type = res.auction_type.id;
                this.form.platform = res.auction_house.id;
                this.form.auction_name = res.auction_name;
                this.form.date = res.date
                this.form.created_date = res.date
                this.form.pak_time = res.pak_time
                this.form.end_time = res?.end_time;
                this.form.lots = res.lots;
                this.form.scr_lots = res.scr_lots;
                this.form.final_sheet = res.final_sheet;
                this.form.notes = res.notes;
                this.form.assign_to = res.assign_to;
                this.form.status = res.status;

            }catch (error) {
                this.$alertStore.add(error.message || 'Failed to fetch record', 'error');
            } finally {
                this.loading = false;
            }
        },

        async updateData(){
            this.loading = true;

            try{
                const res = await General.put("/api/cruds/taskManagement/"+this.form.id, this.form);
                this.$alertStore.add(res.message || "Edit SuccessFully ", "success")
                 this.$router.push('/admin/taskManagement');
            }  catch (error) {
        this.$alertStore.add(error.message || 'Update failed', 'error');
      } finally {
        this.loading = false;
      }     
        }
    }
}
    
</script>