<template>
    <v-dialog
    :model-value="csv.dailog"
    @update:model-value=""
    width="600px"
    >
        <v-card
            prepend-icon="mdi-magnify"
            title="Edit"
        >
        <v-card-actions class="" style="position: absolute; right: 10px; top: 8px;"> 
           <v-icon color="primary" @click="csv.closeModal()">mdi-close</v-icon>
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

            <div class="text-center" >
                <v-btn variant="flat" @click="csv.saveRecord" color="primary">Submit</v-btn>   
            </div>

        </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>

import { useCsvStore } from './CsvStore';


export default {
    name: "VariantModal",
    components: {
    
    },
    data() {
        return {
            csv: useCsvStore(),      
        }
    },
    mounted(){

        
    },
    unmounted(){

        console.log("Component closed / removed from DOM");

    },
    methods: {
   
    }
}
</script>