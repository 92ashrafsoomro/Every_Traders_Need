<template>
    <v-slide-y-transition>
        <div v-if="csvStore.auctionEditFilter" >
         <user-title-bar 
          title="Auction Detail" >
              <v-row class="mt-2" >
                    <v-col cols="12" sm="4">  
                          <v-text-field 
                            v-model="form.id" 
                            variant="outlined" 
                            label="ID"
                            disabled=""
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
                        <StatusDropdown
                            v-model="form.status"
                            label="Status "
                            variant="outlined"
                            density="compact" 
                            min-width="190px" max-width="274px" 
                        />
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
             
                    <v-col cols="12" sm="4" class="" >
                        <v-btn @click="submit()" color="primary" class="text-capitalize"  variant="flat" >Update</v-btn>
                    </v-col>
                </v-row>
</user-title-bar>
        </div>
        </v-slide-y-transition>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import AuctionTypeDropdown from '@/components/AuctionTypeDropdown.vue';
import Auction from '@/models/auction.model';
// import CSVTable from './Csv/index.vue';
import { useCsvStore } from './Csv/CsvStore';
import StatusDropdown from '@/components/StatusDropdown.vue';



export default {
    name:"AuctionEdit",
    components: {
     
        PlateformDropdown,
        AuctionTypeDropdown,
        StatusDropdown
        // CSVTable
    },
    props: {
   show: Boolean
   },
        data() {

        return {
            loading:true,
            csvStore :useCsvStore(),
            // showFilters:false,
            form: {
                id: '',
                name: '',
                status:null,
                auction_date: '',
                end_date: '',
                auction_type:null,
                platform_id: '',
            }
        }
    },
    mounted() {
        this.loadData()

        //   this.$refs.VariantMapping.open(this.$route.params.id);
    },
    methods: {
        async loadData() { 

            const id = this.$route.params.id;
            try {

                let res = await Auction.find(id, {});
            
                
                this.form.name = res.data.name;
                this.form.id = res.data.table_id;
                this.form.auction_date = res.data.auction_date;
                this.form.end_date = res.data.end_date;
                this.form.status = res.data.auction_status;
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
    },

        computed:{
             localShow: {
      get() {
        return this.show
      },
      set(val) {
        this.$emit('update:show', val)
      }
    }}

}
</script>