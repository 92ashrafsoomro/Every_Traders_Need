<template>
     <user-title-bar>
        <div>
            <h1 class="text-h3 mb-2 font-weight-bold">Import CSV Data</h1>
            <p class="text-subtitle-1 mb-2 font-weight-medium">Filter, compare, and uncover vehicles that match your profit goals.</p>
        </div>
    </user-title-bar>
    <v-container max-width="1400px" class="m-auto">
        <v-card class="border">
            <div class="border-b d-flex align-center justify-space-between px-4 py-3">
                <h3 class="text-h6">
                 Edit Auction
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
                            type="datetime-local"
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
                            type="datetime-local"
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
                        <v-btn @click="submit()" color="primary" class="text-capitalize"  variant="flat" >Update</v-btn>
                    </v-col>
                </v-row>
            </v-card-text>

        </v-card>
    </v-container>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import AuctionTypeDropdown from '@/components/AuctionTypeDropdown.vue';
import Auction from '@/models/auction.model';


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
                platform_id: '',
                csv_path:null,
            }
        }
    },
    mounted() {
        this.loadData()
    },
    methods: {
        async loadData() { 

            const id = this.$route.params.id;
            try {

                let res = await Auction.find(id, {});
                console.log(res);
                
                this.form.name = res.data.name;
                this.form.id = res.data.table_id;
                this.form.auction_date = res.data.auction_date;
                this.form.end_date = res.data.end_date;
                this.form.auction_type = Number(res.data.auction_type);
                this.form.platform_id = res.data.platform_id;
                this.form.csv_path = null;

            } catch (error) {
                this.$alertStore.add(error.message, 'error');
                // this.$router.push('/admin/auction');
            }   

        },
        async submit() {

            this.loading = true;

            try {

                if(this.form.auction_type == 'live') {
                    this.form.end_date = null;
                }

                const id = this.$route.params.id;
                let res = await Auction.update(id,this.form);   
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