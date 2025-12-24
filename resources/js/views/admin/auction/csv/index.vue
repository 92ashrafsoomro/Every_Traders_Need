<template>
     <user-title-bar>
        <div>
            <h1 class="text-h3 mb-2 font-weight-bold">Import CSV Data</h1>
            <p class="text-subtitle-1 mb-2 font-weight-medium">Filter, compare, and uncover vehicles that match your profit goals.</p>
        </div>
    </user-title-bar>
    <v-container class="m-auto">
        <v-card :loading="loading" :disabled="loading" class="border">

            <v-file-input
                v-model="csv"
                label="Upload CSV"
                prepend-icon="mdi-file"
                variant="filled"
                @change="handleFile"
                />

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
                        <th>#</th>
                        <th v-for="value in columns" :style="{ width: value?.width }"  class="text-left">
                         {{value.title}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,id) in data" >
                        <td>{{ id }}</td>
                        <td v-for="col in columns">
                            <div v-if="col.key == 'vehicle_id'">
                                  <v-btn @click="handleVehicle(id)">{{ item[col.key] }}</v-btn>
                            </div>
                            <div v-else-if="col.disabled">
                                <input disabled class=" py-2" :value="item[col.key]" />
                            </div>
                            <div v-else>
                                <input class="border py-2 px-1" :value="item[col.key]" @change="updateCell(id, col.key, $event.target.value)" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </v-table>
            </v-card-text>
        </v-card>



        <v-btn @click="handleVehicle(1)" >Open</v-btn>
        
        <PopUp :dailog="vehicleDailog" :onChange="hanldeDailog"   />

    


    </v-container>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import Auction from '@/models/auction.model';
import columns from './columns'
import cskMaker from '@/plugins/cskMaker';
import PopUp from './PopUp.vue';


import { useCsvStore } from '@/stores/csvStore';


export default {
    components: {
        PlateformDropdown,
        PopUp
    
    },
    data() {

        return {
            
            vehicleDailog:false,
            loading: false,
            csv:useCsvStore(),
            data: [],
            platform_id:'',

            vehicles: [],
            body: [],
            make: [],
            model: [],
            variant:[],
         
            columns: columns,
          
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
        // this.loadData()
        // this.loadVehicles();
        // this.loadBody();
        // this.loadMake();
        // this.loadModel();
        // this.loadVariant();

        
    },
    methods: {
    
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
      
        async handleFile(event) {

            this.loading = true;
            const file = event.target.files[0];
            try {
                this.data = await cskMaker(file);
                this.loading = false;
            } catch (error) {
                console.log(error);
                this.loading = false;
            }
        },
        updateCell(rowIndex, key, value) {

            this.data[rowIndex][key] = value;
        },
        handleVehicle(row) {

            this.vehicleDailog = true;
            
        },
        hanldeDailog(e) {

            this.vehicleDailog = e;
            console.log('open',e);
            
        }   
    
   


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