<template>
    <v-dialog
    :model-value="dailog"
    @update:model-value=""
    width="600px"
    >
        <v-card
            prepend-icon="mdi-magnify"
            title="Edit"
        >
        <v-card-actions class="" style="position: absolute; right: 10px; top: 8px;"> 
           <v-icon color="primary" @click="close()">mdi-close</v-icon>
        </v-card-actions>
        <v-card-text v-if="csv.row" >

            <div class="">
                <v-text-field 
                  v-if="csv.makes.selected" 
                   readonly :model-value="csv.makes.selected.name" 
                   append-inner-icon="mdi-close"
                   label="Make"
                   @click:append-inner="csv.clearMake"
                   variant="outlined"
                  />
                <v-text-field v-else
                    label="Make" 
                    v-model="csv.makes.search" 
                    @keyup.enter="csv.makeSearch"/>
                <ul class="mt-2">
                    <li v-if="csv.makes.loading" >Loading...</li>
                    <li class="text-center" v-else-if="csv.makes.length == 0 && csv.makes.search != null" >No Record</li>
                    <li v-else @click="csv.selectMake(item)" 
                        class="py-3 px-2 mx-1 border" 
                        v-for="item in csv.makes.data"
                    >{{ item.id }} - {{ item.name }}</li>
                </ul>
            </div>

            <div class="">
                <v-text-field 
                  v-if="csv.models.selected" 
                   readonly :model-value="csv.models.selected.name" 
                   append-inner-icon="mdi-close"
                   label="Model"
                   @click:append-inner="csv.clearModel"
                   variant="outlined"
                  />
                <v-text-field v-else
                    label="Model" 
                    v-model="csv.models.search" 
                    @keyup.enter="csv.modelSearch"/>
                <ul class="mt-2">
                    <li v-if="csv.models.loading" >Loading...</li>
                    <li class="text-center" v-else-if="csv.models.length == 0 && csv.models.search != null" >No Record</li>
                    <li v-else @click="csv.selectModel(item)" 
                        class="py-3 px-2 mx-1 border" 
                        v-for="item in csv.models.data"
                    >{{ item.id }} - {{ item.name }}</li>
                </ul>
            </div>

            <div class="">
                <v-text-field 
                  v-if="csv.variants.selected" 
                   readonly :model-value="csv.variants.selected.name" 
                   append-inner-icon="mdi-close"
                   label="Variant"
                   @click:append-inner="csv.clearVariant"
                   variant="outlined"
                  />
                <v-text-field v-else
                    label="Variant" 
                    v-model="csv.variants.search" 
                    @keyup.enter="csv.variantSearch"/>
                <ul class="mt-2">
                    <li v-if="csv.variants.loading" >Loading...</li>
                    <li class="text-center" v-else-if="csv.variants.length == 0 && csv.variants.search != null" >No Record</li>
                    <li v-else @click="csv.selectVariant(item)" 
                        class="py-3 px-2 mx-1 border" 
                        v-for="item in csv.variants.data"
                    >{{ item.id }} - {{ item.name }}</li>
                </ul>
            </div>

        </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>
import Variant from '@/models/variant.model';

import ModelDropdown from '@/components/ModelDropdown.vue';
import { useCsvStore } from './CsvStore';
import General from '@/models/general.model';
import { useMakeStore } from '@/stores/makeStore';


export default {
    name: "VariantModal",
    components: {
        ModelDropdown
    },
    watch: {
        dailog(newVal) {

            if (newVal) {
                
            } else {
                this.data = [];
                this.value = '';
            }

        },
    },
    emits: ['update:dailog'],
    data() {
        
        return {
            row: null,
            make:useMakeStore(),
            csv: useCsvStore(),
            dailog:false,
            loading: false,
            makeId: null,
            modelId:null,
            row:null,
            search: '',
            data: [],            
        }
    },
    mounted(){

        
    },
    unmounted(){

        console.log("Component closed / removed from DOM");

    },
    methods: {
        handleModel($event) {
            this.modelId = Number($event.id);
            this.handleSearch();
        },
        async handleSearch() {

            if (!this.makeId) {
                return false;
            }

            if (!this.modelId) {
                return false;                
            }
            
            try {
                this.loading = true;
                let res = await Variant.all({
                    make_id: this.makeId,
                    model_id:this.modelId,
                    search: this.search,
                    length: 10
                });
                this.data = res.data;
                this.loading = false;
            } catch (error) {
               this.loading = false;
               alert(error);
           }
        },
        async selectValue(item) {
            this.dailog = false;
            this.$emit('update:dailog',this.row,'variant_id',item.name);
        },
        async findMakebyName() {

            let res = await General.get('/api/cruds/make', { name: this.csv.row.make_id });
            if(res.data && res.data.length > 0) {
                this.csv.makes.selected = {
                    name: res.data[0].name,
                    id:res.data[0].id,
                }
                this.findModelName(res.data[0].id);
            } else {
                this.csv.makes.search = this.csv.row.make_id;
            }

        },
        async findModelName(make_id) {

            let res = await General.get('/api/cruds/model', { name: this.csv.row.model_id,make_id:make_id });
            if(res.data && res.data.length > 0) {
                this.csv.models.selected = {
                    name: res.data[0].name,
                    id:res.data[0].id,
                }
                this.findVariantName(res.data[0].id);
            } else {
                this.csv.models.search = this.csv.row.model_id;
            }
        },
        async findVariantName(model_id) {

            let res = await General.get('/api/cruds/variant', { name: this.csv.row.variant_id,model_id:model_id });
            if(res.data && res.data.length > 0) {
                this.csv.variants.selected = {
                    name: res.data[0].name,
                    id:res.data[0].id,
                }
            } else {
                this.csv.variants.search = this.csv.row.variant_id;
            }
        },
        open(row) {
            this.csv.openRow(row);

            if (this.csv.row) {

                this.csv.makes.search = this.csv.row.make_id;
                this.csv.models.search = this.csv.row.model_id;
                this.csv.variants.search = this.csv.row.variant_id;


                this.findMakebyName()
                this.search = this.csv.row.variant_id;
                this.dailog = true;
                this.handleSearch();
            }
     

        },

        close() {
            
            this.csv.row = null;

        

        },
    }
}
</script>