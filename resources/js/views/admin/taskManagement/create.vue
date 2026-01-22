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

      <!-- Auction Type -->
      <v-col cols="12" md="6">
        <AuctionTypeDropdown
          label="Choose Auction Type"
          density="compact"
          base-color="white"
          v-model="form.auction_type"
          variant="outlined"
        />
      </v-col>

      <!-- Auction House -->
      <v-col cols="12" md="6">
        <PlateformDropdown
          label="Auction House"
          density="compact"
          base-color="white"
          v-model="form.platform"
          variant="outlined"
        />
      </v-col>

      <!-- Auction Name -->
      <v-col cols="12" md="6">
        <v-text-field
          label="Auction Name"
          variant="outlined"
          density="compact"
          v-model="form.auction_name"
          clearable
        />
      </v-col>

      <!-- Auction Date -->
      <v-col cols="12" md="6">
        <v-text-field
          label="Auction Date"
          variant="outlined"
          density="compact"
           type="datetime-local"
          v-model="form.date"
          clearable
        />
      </v-col>

      <!-- Auction Time -->
      <v-col cols="12" md="6">
        <v-text-field
          label="Auction Date Time"
          variant="outlined"
          density="compact"
           type="datetime-local"
          v-model="form.created_date"
          clearable
        />
      </v-col>

      <!-- End Date -->
      <v-col cols="12" md="6">
        <v-text-field
          label="End Date"
          variant="outlined"
          density="compact"
          type="date"
          v-model="form.end_date"
          clearable
        />
      </v-col>

      <!-- Status -->
      <v-col cols="12" md="6">
        <StatusDropdown
          label="Status"
          variant="outlined"
          density="compact"
          clearable
          item-title="title"
          item-value="title"
          v-model="form.status"
        />
      </v-col>
   <v-col cols="12" md="6">
        <v-text-field
          label="Lots"
          variant="outlined"
          density="compact"
          v-model="form.lots"
          clearable
        />
      </v-col> <v-col cols="12" md="6">
        <v-text-field
          label="Assign To"
          variant="outlined"
          density="compact"
          v-model="form.assign_to"
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
               id: '',
                auction_type : null,
                platform :null,
                auction_name : "",
                date : "",
                created_date : "",
                end_date : "",
                pak_time : "",
                status : null,
                lots: '',
                assign_to: ''
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