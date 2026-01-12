<template>
    <v-dialog
    :model-value="dailog"
    @update:model-value=""
    width="1800px"
    >
        <v-card
            prepend-icon="mdi-magnify"
            title="Variant Mapping"
        >
         <v-card-actions class="" style="position: absolute; right: 10px; top: 8px;"> 
           <v-icon color="primary" @click="dailog = false;">mdi-close</v-icon>
         </v-card-actions>
        <v-card-text>
            <v-btn @click="handleFile()" color="primary" variant="flat">Load</v-btn>
            <v-table class="table border" >
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Variant</th>
                </tr>
                <tr v-for="(item, index) in data" :key="index" >
                    <td class="border" >{{ index }}</td>
                    <td class="border" >{{ item.title }} | {{ item.derivative }}</td>
                    <td class="border" >{{ item.variant_id }} </td>
                    <td class="border" >{{ item.variant_id }} </td>
                    <td class="border" >{{ item.variant_id }}
                       <!-- <VariantDropDown modelId="1" item-title="full" item-value="id" :model-value="item.derivative" @update:modelValue="console.log($event)" /> -->
                    </td>
                </tr>
            </v-table>
        </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>
import Auction from '@/models/auction.model';
import { ColRender } from '@/plugins/cskMaker';
import VariantDropDown from './VariantDropDown.vue';



export default {
    name: "VariantMapping",
    components: {
        VariantDropDown
    },
    watch: {
        dailog(newVal) {
            if (newVal) {
                
            } else {
                // this.data = [];
                // this.value = '';
            }
        },
    },
    emits: ['update:dailog'],
    data() {
        return {
            id:274,
            dailog:true,
            loading: false,
            row:null,
            search: '',
            data: [],            
        }
    },
    mounted() {

        this.handleFile()
        
    },
    methods: {
        async handleFile() {

                this.loading = true;
                this.errors = {};
                try {
                    
                    let res = await Auction.getScrap(this.id, {});
                    let modified = [];
                    let data = res.data ?? [];
                    data.forEach(element => {
                        element.derivative = element.variant_id;
                        element.variant_id = null;
                        modified.push(ColRender(element));
                    });

                    this.data = modified;
                    this.loading = false;

                } catch (error) {
                    this.$alertStore.add(error.message, 'error');
                    this.loading = false;
                }
                
        },

        async selectValue(item) {

            // this.dailog = false;
            // this.$emit('update:dailog',this.row,'body_id',item.name);
        },
        open(id) {
           
            this.id = id;
            // this.row = row;
            // this.search = initialValue;
            this.dailog = true;
           

            

        },
    }
}
</script>


<style scoped >

    th{
        border: 1px solid;
    }

    td{
        border: 1px solid;
    }


</style>