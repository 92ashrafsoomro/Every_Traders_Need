<template>
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
                          <v-select 
                            v-model="form.auction_type" 
                            variant="outlined" 
                            label="Auction Type"
                            :items="['Online','Live']"
                            base-color="white"
                            density="compact" 
                            color="primary"  
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
                    <v-col cols="12" sm="4" >
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
               

                    <v-col cols="4">
                        <v-file-input
                            v-model="form.csv_path"
                            label="Upload CSV"
                            prepend-icon="mdi-file"
                            variant="filled"
                            />
                    </v-col>
                    <v-col cols="12" class="text-center" >
                        <v-btn @click="submit()" color="primary" variant="flat" >Submit</v-btn>
                    </v-col>
                </v-row>
            </v-card-text>

        </v-card>
    </v-container>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import Auction from '@/models/auction.model';


export default {

    components:{PlateformDropdown},
    data() {

        return {
            loading:true,
            form: {
                id: '',
                name: '',
                auction_date: '',
                end_date: '',
                auction_type:'Online',
                platform_id: '',
                csv_path:null,
            }
        }
    },
    methods: {
        async submit() {

                this.loading = true;

                try {

                    let res = await Auction.create(this.form);   
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