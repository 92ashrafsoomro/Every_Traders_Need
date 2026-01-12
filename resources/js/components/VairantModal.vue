<template>
    <v-dialog
    :model-value="dailog"
    @update:model-value=""
    width="600px"
    >
        <v-card
            prepend-icon="mdi-magnify"
            title="Variant"
        >
         <v-card-actions class="" style="position: absolute; right: 10px; top: 8px;"> 
           <v-icon color="primary" @click="dailog = false;">mdi-close</v-icon>
         </v-card-actions>
        <v-card-text>

            <MakeDropdown 
               item-title="name" 
               item-id="id" 
               :model-value="makeId"
               @update:model-value="modelId = $event" 
               label="Make" 
               @update:modelValue="handleSearch"
                />

            <ModelDropdown 
                item-title="name" 
                item-id="id" 
                :make="makeId" 
                :modelValue="modelId"
                @update:model-value="modelId = $event" 
                @update:modelValue="handleSearch" 
                label="Model" />


            <v-text-field v-model="search" @keyup.enter="handleSearch()"/>
                <ul class="mt-2">
                    <li v-if="loading" >Loading...</li>
                    <li class="text-center" v-if="data.length == 0" >No Record</li>
                    <li style="cursor: pointer;" v-else @click="selectValue(item)" class="py-3 px-2 mx-1 border" v-for="item in data"
                    >{{ item.makeName }} - {{ item.modelName }} - {{ item.id }} - {{ item.name }}</li>
                </ul>
        </v-card-text>
     
        </v-card>
    </v-dialog>
</template>
<script>
import Variant from '@/models/variant.model';
import MakeDropdown from './MakeDropdown.vue';
import ModelDropdown from './ModelDropdown.vue';



export default {
    name: "VariantModal",
    components: {
        MakeDropdown,
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
            dailog:false,
            loading: false,
            makeId: null,
            modelId:null,
            row:null,
            search: '',
            data: [],            
        }
    },
    mounted() {
   
        
    },
    methods: {

        async handleSearch(){
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
        open(row,initialValue = '') {
            this.row = row;
            this.search = initialValue;
            this.dailog = true;
            this.handleSearch();

        },
    }
}
</script>