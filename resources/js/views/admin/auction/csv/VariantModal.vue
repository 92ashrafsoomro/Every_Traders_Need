<template>
    <v-dialog
    :model-value="csv.dailog"
    @update:model-value=""
    width="800px"
    >
        <v-card>
          <div class="card-title d-flex align-center" v-if="csv.row">
                <v-icon class="mr-2">mdi-magnify</v-icon>

                <h4 class="card-title-text text-h6">
                {{ csv.row.title }}
                </h4>
            </div>

            <v-card-actions style="position: absolute; right: 10px; top: 8px;"> 
                <v-icon color="primary" @click="csv.reload()">mdi-reload</v-icon>
                <v-icon color="primary" @click="csv.closeModal()">mdi-close</v-icon>
            </v-card-actions>
        <v-card-text v-if="csv.row" >

         <div class=""> 
        <v-text-field 
            v-if="csv.makes.selected" 
            readonly 
            :model-value="csv.makes.selected.name" 
            append-inner-icon="mdi-close"
            label="Make"
            @click:append-inner="csv.clearMake"
            variant="outlined"
        />
        
        <v-text-field 
            v-else
            label="Make" 
            v-model="csv.makes.search" 
            @keyup.enter="csv.makeSearch"
        />

        <v-list class="mt-2  custom-scroll">
            <v-list-item v-if="csv.makes.loading">Loading...</v-list-item>
            <v-list-item class="text-center" v-else-if="csv.makes.length == 0 && csv.makes.search != null">
                    No Record
                    </v-list-item>
                    <v-list-item 
                    v-else 
                    @click="csv.selectMake(item)" 
                    class="py-3 px-2 mx-1 border" 
                    v-for="item in csv.makes.data"
                    >
                    {{ item.id }} - {{ item.name }}
            </v-list-item>
        </v-list>
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
                 <v-list class="mt-2 custom-scroll ">
            <v-list-item v-if="csv.models.loading">Loading...</v-list-item>
            <v-list-item class="text-center" v-else-if="csv.makes.length == 0 && csv.models.search != null">
                    No Record
                    </v-list-item>
                    <v-list-item 
                    v-else 
                    @click="csv.selectModel(item)" 
                    class="py-3 px-2 mx-1  border " 
                    v-for="item in csv.models.data"
                    >
                    {{ item.id }} - {{ item.name }}
            </v-list-item>
        </v-list>
            </div>

            <div class="">
                <div>
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
                    append-inner-icon="mdi-plus"
                    @click:append-inner="addNewVariantForm()" 
                    v-model="csv.variants.search" 
                    @keyup.enter="csv.variantSearch"/>
                </div>
                 <v-list class="mt-2 custom-scroll ">
            <v-list-item v-if="csv.variants.loading">Loading...</v-list-item>
            <v-list-item class="text-center" v-else-if="csv.variants.length == 0 && csv.variants.search != null">
            No Record
            </v-list-item>
            <v-list-item 
            v-else 
            @click="csv.selectModel(item)" 
            class="py-3 px-2 mx-1  border " 
            v-for="item in csv.variants.data"
            >
            {{ item.id }} - {{ item.name }}
            </v-list-item>
        </v-list>
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
import { useRouter } from 'vue-router'


export default {
    name: "VariantModal",
    components: {
    
    },
    data() {
        return {
            csv: useCsvStore(),      
            router: useRouter() 
        }
    },
    mounted(){

        
    },
    unmounted(){

        console.log("Component closed / removed from DOM");

    },
    methods: {
        addNewVariantForm() {

            const newRoute = this.router.resolve({
                path: '/admin/variant/create'
            });
            window.open(newRoute.href, '_blank');

        },
    }
}
</script>

<style>
    .card-title {
  max-width: 500px;
  margin: 16px 60px 8px 16px;
}

.card-title-text {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  min-width: 0;    
  flex: 1;           
  font-weight: 600;
}

.custom-scroll {
  max-height: 200px; 
  overflow-y: auto;  
  /* padding-bottom: 30px; */
}
</style>