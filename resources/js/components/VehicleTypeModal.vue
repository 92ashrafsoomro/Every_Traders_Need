<template>
    <v-dialog
    :model-value="dailog"
    @update:model-value=""
    width="600px"
    >
        <v-card
            prepend-icon="mdi-update"
            title="Vehicle Type"
        >
        <v-card-text>
            <v-text-field  
                @keyup.enter="handleSearch()"
                v-model="search"
                />
                <ul class="mt-2">

                    <li v-if="loading" >Loading...</li>
                    <li class="text-center" v-if="data.length == 0" >No Record</li>
                    <li v-else  style="cursor: pointer;" 
                        @click="selectValue(item)" 
                        class="py-3 px-2 mx-1 border" 
                        v-for="item in data">{{ item.id }} - {{ item.name }}</li>
                </ul>
        </v-card-text>
         <v-card-actions>
            <v-btn variant="flat" color="primary" @click="dailog = false;" >Close</v-btn>
         </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import VehicleType from '@/models/vehicle-type.model';

export default {
    name:"VehicleTypeModal",
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
            loading:false,
            row:null,
            dailog:false,
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
               let res = await VehicleType.all({ search: this.search ,length:10});
                this.data = res.data;
               this.loading = false;
            } catch (error) {
             this.loading = false;
               alert(error);
              
           }
        },
        async selectValue(item) {
            this.dailog = false;
            this.$emit('update:dailog',this.row,'vehicle_id',item.name);
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