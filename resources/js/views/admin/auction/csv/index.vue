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
                    <tr v-for="(item,id) in data" @click="selectedRow = id" >
                        <td>{{ id }}</td>
                        <td v-for="col in columns">
                            <div v-if="col.key == 'vehicle_id'">
                                <span  @click="this.$refs.auctionTypeModal.open(item[col.key])" >{{ item[col.key] }}</span>
                              
                            </div>
                            <div v-else-if="col.key == 'body_id'">
                                <span  @click="this.$refs.bodyTypeModal.open(item[col.key])" >{{ item[col.key] }}</span>
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

        <AuctionTypeModal ref="auctionTypeModal" @update:dailog="hanldeDailog('vehicle_id',$event)"/>
        <BodyTypeModal ref="bodyTypeModal" @update:dailog="hanldeDailog('body_id',$event)"/>

   
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';
import Auction from '@/models/auction.model';
import columns from './columns'
import cskMaker, { ColRender } from '@/plugins/cskMaker';
import AuctionTypeModal from '@/components/AuctionTypeModal.vue';
import BodyTypeModal from '@/components/BodyTypeModal.vue';

export default {
    components: {
        PlateformDropdown,
        AuctionTypeModal,
        BodyTypeModal
    },
    data() {

        return {
            auction_id:this.$route.params.id,
            selectedRow:null,
            loading: false,
            data: [],
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
        updateCell(rowIndex, key, value) {
            this.data[rowIndex][key] = value;
        },
        hanldeDailog(key,e) {
            this.data[this.selectedRow][key] = e; 
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