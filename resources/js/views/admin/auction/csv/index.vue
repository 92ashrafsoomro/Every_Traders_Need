<template>
     <user-title-bar>
        <div>
            <h1 class="text-h3 mb-2 font-weight-bold">Import CSV Data</h1>
            <p class="text-subtitle-1 mb-2 font-weight-medium">Filter, compare, and uncover vehicles that match your profit goals.</p>
        </div>
    </user-title-bar>
    <v-container class="m-auto">
        <v-card class="border">
            <div class="border-b d-flex align-center justify-space-between px-4 py-3">
                <h3 class="text-h6">
                 Edit CSV
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

            <v-table
                style=" table-layout: fixed;
            width: 100%;"
             height="500px"
             fixed-header
            >
                <thead>
                    <tr>
                        <th v-for="value in columns" :style="{ width: value?.width }"  class="text-left">
                         {{value.title}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item ,key) in data" >
                        <td v-for="col in columns">
                            <div v-if="col.disabled"  >
                                <input disabled class=" py-2" :value="item[col.key]" >
                            </div>
                             <div v-else >

                                <div v-if="col.key == 'vehicle_id'">
                                    <select style="width: 200px;" v-model="data[key][col.key]" >
                                        <option v-for="v in vehicles" :value="v.id">{{ v.name }}</option>
                                    </select>
                                </div>

                                <div v-else-if="col.key == 'body_id'">
                                    <select style="width: 200px;" v-model="data[key][col.key]" >
                                       <option v-for="b in body" :value="b.id">{{ b.name }}</option>
                                     </select>
                                </div>

                                 <div v-else-if="col.key == 'make_id'">
                                    <select style="width: 200px;" v-model="data[key][col.key]" >
                                       <option v-for="m in make" :value="m.id">{{ m.name }}</option>
                                     </select>
                                </div>
                                 <div v-else-if="col.key == 'model_id'">
                                    <select style="width: 200px;" v-model="data[key][col.key]" >
                                       <option v-for="b in model" :value="b.id">{{ b.name }}</option>
                                     </select>
                                </div>
                                <div v-else-if="col.key == 'variant_id'">
                                    <select style="width: 200px;" v-model="data[key][col.key]" >
                                       <option v-for="v in variant" :value="v.id">{{ v.name }}</option>
                                     </select>
                                </div>
                                <div v-else >
                                    <input  class="border py-2 px-1" v-model="data[key][col.key]" >
                                </div>

                             

                                
                            </div>
                        </td>
                    </tr>
                </tbody>
            </v-table>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import Auction from '@/models/auction.model';
import columns from './columns'
import VehicleType from '@/models/vehicle-type.model';
import BodyType from '@/models/body-type.model';
import Make from '@/models/make.model';
import Model from '@/models/vehicle-model.model';
import Variant from '@/models/variant.model';


export default {

    components:{PlateformDropdown},
    data() {

        return {
            vehicles: [],
            body: [],
            make: [],
            model: [],
            variant:[],
            loading: true,
            columns: columns,
            data:[],
            form: {
                id: '',
                name: '',
                auction_date: '',
                end_date: '',
                auction_type:'online',
                platform_id: '',
                csv_path:null,
            }
        }
    },
    mounted() {
        this.loadData()
        this.loadVehicles();
        this.loadBody();
        this.loadMake();
        this.loadModel();
        // this.loadVariant();

        
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
                this.form.auction_type = res.data.auction_type;
                this.form.platform_id = res.data.platform_id;
                this.form.csv_path = null;


                this.data = res.data.vehicle;


                // this.renderData();
            
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

            
        },

        async renderData() {

            // let data = [];

            // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10].forEach(item => {
            //     let obj = {};
            //     this.columns.forEach(col => {
            //         obj[col.key] = item;
            //     });
            //     data.push(obj);
            // });


            // this.data = data;
            
        },

        async loadVehicles() {
            try {
                let res = await VehicleType.all();
                this.vehicles = res.data;
            } catch (error) {
                
            }
           
        },
        async loadBody() {
            try {
                let res = await BodyType.all({length:100000});
                this.body = res.data;

             
                
            } catch (error) {
                
            } 
        },
        async loadMake() {
            try {
                let res = await Make.all({length:100000});
                this.make = res.data;

              
                
            } catch (error) {
                
            } 
        },
        async loadModel() {
            try {
                let res = await Model.all({length:100000});
                this.model = res.data;

                
            
            } catch (error) {
                
            } 
        },

        async loadVariant() {
            try {
                let res = await Variant.all({length:100000});
                this.variant = res.data;

                
            
            } catch (error) {
                
            } 
        },


        
        
        


    }



    
}

</script>

<style lang="css" scoped >

.truncate {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

td{
    width: auto;
}

</style>