<template>
     <user-title-bar title="Import CSV Data">
        <div>
            <p class="text-subtitle-1 mb-2 font-weight-medium">Filter, compare, and uncover vehicles that match your profit goals.</p>
        </div>
    </user-title-bar>
    <v-container max-width="1400px" class="m-auto">
        <v-card class="border">
            <div class="border-b d-flex align-center justify-space-between px-4 py-3">
                <h3 class="text-h6">
                 Create Auction
                </h3>
                    <v-btn
                    variant="text"
                    color="primary"
                    class="text-capitalize"
                    to="/admin/auction">
                    <v-icon start>mdi-arrow-left</v-icon>
                    Back
                    </v-btn>
            </div>

            <v-card-text>
                <v-row>
                    <v-col cols="12" sm="4">  
                          <v-text-field 
                            v-model="form.id" 
                            variant="outlined" 
                            label="ID"
                            base-color="white" 
                            color="primary"
                            density="compact" 
                            clearable />
                    </v-col>
                    <v-col cols="12" sm="4">
                          <v-text-field 
                            v-model="form.name" 
                            variant="outlined" 
                            label="Name"
                            base-color="white" 
                            color="primary"
                            density="compact" 
                            clearable />
                    </v-col>
                    <v-col cols="12" sm="4">
                          <AuctionTypeDropdown 
                            v-model="form.auction_type"
                            label="Auction Type"
                            variant="outlined" 
                            base-color="white"
                            density="compact" 
                            />
                    </v-col>
                    <v-col cols="12" sm="4" >
                          <v-text-field 
                            v-model="form.auction_date" 
                            variant="outlined" 
                            label="Auction Date"
                            type="date"
                            density="compact"
                            base-color="white" 
                            color="primary"  
                            clearable />
                    </v-col>
                    <v-col cols="12" sm="4" v-if="form.auction_type != 2" >
                          <v-text-field 
                            v-model="form.end_date" 
                            variant="outlined" 
                            label="End Date"
                            type="date"
                            density="compact"
                            base-color="white" 
                            color="primary" 
                            clearable />
                    </v-col>
                    <v-col cols="12" sm="4" >
                        <PlateformDropdown 
                            v-model="form.platform_id"
                            label="Auction House"
                            variant="outlined" 
                            base-color="white"
                            density="compact" 
                            />
                    </v-col>
               
                    <v-col cols="12" class="text-end" >
                        <v-btn @click="submit()" color="primary" class="text-capitalize"  variant="flat" >Submit</v-btn>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import AuctionTypeDropdown from '@/components/AuctionTypeDropdown.vue';
import AuctionSchedule from '@/models/auctionSchedule.model';


export default {

    components:{PlateformDropdown,AuctionTypeDropdown},
    data() {

        return {
            loading:true,
            form: {
                id: '',
                name: '',
                auction_date: '',
                end_date: '',
                auction_type:null,
                platform_id: null,
         
            }
        }
    },
    methods: {
        async submit() {

                this.loading = true;

            try {

                    if (this.form.auction_type == 2) {
                        this.form.end_date = null;
                    }

                    let res = await AuctionSchedule.create(this.form);   
                    this.$alertStore.add(res.message, 'success');
                    this.$router.push('/admin/auction');
                
                } catch (error) {
                    console.error(error);
                    this.$alertStore.add(error.message, 'error');
                } finally {
                    this.loading = false;
                    
                }
        
            
        }
    }
    
}

</script>