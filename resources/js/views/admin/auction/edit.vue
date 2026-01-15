<template>
     
   <IconMenu @toggle="toggleSidebar" />
        <AuctionFilter :show="showSidebar" />
    <v-container  class="m-auto">

        <!-- <VariantMapping ref="VariantMapping"/> -->
         <CSVTable   @toggle="toggleSidebar" />
    </v-container>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import AuctionTypeDropdown from '@/components/AuctionTypeDropdown.vue';
import Auction from '@/models/auction.model';
import CSVTable from './Csv/index.vue';
import VariantMapping from '@/components/VariantMapping.vue';
import AuctionFilter from '@/components/auctionfilter.vue';


export default {

    components: {
        VariantMapping,
        PlateformDropdown,
        AuctionTypeDropdown,    
        CSVTable,
        AuctionFilter
    },
    data() {

        return {
            // loading:true,
            // form: {
            //     id: '',
            //     name: '',
            //     status:null,
            //     auction_date: '',
            //     end_date: '',
            //     auction_type:null,
            //     platform_id: '',
            // }
            showSidebar: false
        }
    },
    // mounted() {
    //     this.loadData()

    //     //   this.$refs.VariantMapping.open(this.$route.params.id);
    // },
    methods: {
         toggleSidebar() {
      this.showSidebar = !this.showSidebar
    }
    //     async loadData() { 

    //         const id = this.$route.params.id;
    //         try {

    //             let res = await Auction.find(id, {});
            
                
    //             this.form.name = res.data.name;
    //             this.form.id = res.data.table_id;
    //             this.form.auction_date = res.data.auction_date;
    //             this.form.end_date = res.data.end_date;
    //             this.form.status = res.data.status;
    //             this.form.auction_type = Number(res.data.auction_type);
    //             this.form.platform_id = res.data.platform_id;
    //             this.form.csv_path = null;

    //         } catch (error) {
    //             this.$alertStore.add(error.message, 'error');
    //             // this.$router.push('/admin/auction');
    //         }   

    //     },
    //     async submit() {

    //         this.loading = true;

    //         try {

    //             if(this.form.auction_type == 'live') {
    //                 this.form.end_date = null;
    //             }

    //             const id = this.$route.params.id;
    //             let res = await Auction.update(id,this.form);   
    //             this.$alertStore.add(res.message, 'success');
    //             this.$router.push('/admin/auction');
                
    //         } catch (error) {
    //             console.error(error);
    //             this.$alertStore.add(error.message, 'error');
    //         } finally {
    //             this.loading = false;
    //         }
                
    //     }


    }



    
}

</script>