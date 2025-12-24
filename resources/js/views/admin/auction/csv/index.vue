<template>

        <v-card :loading="loading" :disabled="loading" class="my-3 border">

            <div class="d-flex justify-space-between border-b py-3 px-4" >
                <div class="align-self-center" >
                    <h1 class=" text-h6 Sheet">CSV</h1>
                </div>

                <div class="mx-3 d-flex">
                    <div class="px-2" >
                        <v-icon @click="submit" style="padding: 20px;" class="border" >mdi-share</v-icon>
                    </div>
                    <div class="px-2" >
                        <v-icon style="padding: 20px;" class="border" @click="this.$refs.mycsvfile.click()" >mdi-file</v-icon>
                        <v-file-input
                            ref="mycsvfile"
                            class="border text-center d-none"
                            v-model="csv"
                            @change="handleFile"
                            />
                    </div>
                </div>
            </div>
            <v-card-text>
           
            <v-table
                style="table-layout: fixed;
                width: 100%;"
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
                    <tr v-for="(item,id) in data"  >

                        <td>{{ id }}</td>
                        <td v-for="col in columns">
                            <div v-if="col.key == 'vehicle_id'">
                                <span class="pointer"  @click="OpenModal(id,'vehicle_id',item[col.key])" >{{ item[col.key] }}</span>
                            </div>
                            <div v-else-if="col.key == 'body_id'">
                                <span class="pointer"  @click="OpenModal(id,'body_id',item[col.key])" >{{ item[col.key] }}</span>
                            </div>
                            <div v-else-if="col.key == 'make_id'">
                                <span class="pointer"  @click="OpenModal(id,'make_id',item[col.key])" >{{ item[col.key] }}</span>
                            </div>
                            <div v-else-if="col.key == 'center_id'">
                                <span class="pointer"  @click="OpenModal(id,'center_id',item[col.key])" >{{ item[col.key] }}</span>
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

        <VehicleTypeModal ref="vehicleTypeModalModal" @update:dailog="hanldeDailog"/>
        <BodyTypeModal ref="bodyTypeModal" @update:dailog="hanldeDailog"/>
        <MakeModal ref="makeModal" @update:dailog="hanldeDailog"/>
        <CenterModal ref="centerModal" @update:dailog="hanldeDailog"/>

   
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import Auction from '@/models/auction.model';
import columns from './columns'
import cskMaker, { ColRender } from '@/plugins/cskMaker';
import VehicleTypeModal from '@/components/VehicleTypeModal.vue';
import BodyTypeModal from '@/components/BodyTypeModal.vue';
import MakeModal from '@/components/MakeModal.vue';
import CenterModal from '@/components/CenterModal.vue';

export default {
    components: {
        PlateformDropdown,
        VehicleTypeModal,
        BodyTypeModal,
        MakeModal,
        CenterModal
    },
    data() {

        return {
            auction_id:this.$route.params.id,
            selectedRow:null,
            loading: false,
            data: [],
            columns: columns,
            csv:null,
        }
    },
    mounted() {

      
        this.loadVehicle()
        
    },
    methods: {

        async loadVehicle() {

            this.loading = true;
            const id = this.$route.params.id;
            try {

                let res = await Auction.csvGet(id, {});
                let data = res.data.data;
                let modified = [];
                data.forEach(element => {
                    modified.push(ColRender(element));
                });
                this.data = modified;
                this.loading = false;
                this.$alertStore.add('Data Loaded', 'success');

            } catch (error) {
                this.loading = false;
                this.data = [];
                this.$alertStore.add(error.message, 'error');
            }

        },
        async submit() {

            this.loading = true;
            try {

                const id = this.$route.params.id;
                let res = await Auction.csvUpdate(id, {data: this.data});   
                this.$alertStore.add(res.message, 'success');
                this.loadVehicle();

            } catch (error) {

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
        OpenModal(row,key,value) {
         switch (key) {
            case 'vehicle_id':
                this.$refs.vehicleTypeModalModal.open(row, value);
                break;
            case 'body_id':
                this.$refs.bodyTypeModal.open(row, value);
                 break;
            case 'make_id':
                this.$refs.makeModal.open(row, value);
                 break;
            case 'center_id':
                this.$refs.centerModal.open(row, value);
                break;
            
         }
        },
        updateCell(rowIndex, key, value) {
            this.data[rowIndex][key] = value;
        },
        hanldeDailog(row,key,e) {
            this.data[row][key] = e; 
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

.activeRow{
    background-color: red!important;
}


.pointer{
    cursor: pointer;
}
</style>