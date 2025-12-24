<template>
    <v-dialog
    v-model="dailog"
    width="600px"
    >
        <v-card
            prepend-icon="mdi-update"
            title="Auction Type"
        >
        <v-card-text>
            <v-text-field  
                @update:model-value="handleSearch($event)"
                :value="search"
                />
                <ul class="mt-2" >
                    <li @click="selectValue(item)" class="py-3 px-2 mx-1 border" v-for="item in data">{{ item.name }}</li>
                </ul>
        </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>
import VehicleType from '@/models/vehicle-type.model';

export default {
    name:"AuctionTypeModal",
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
            search: '',
            data: [],            
        }
    },
    mounted() {
   
        
    },
    methods: {

        async handleSearch(e){
           this.value = e;
           try {
               let res = await VehicleType.all({ search: e });
               this.data = res.data;
           } catch (error) {
               alert(error);
              
           }
        },
        async selectValue(item) {
            this.dailog = false;
            this.$emit('update:dailog', item.name);
        },
        open(initialValue = '') {

            this.search = initialValue;
            this.dailog = true;
            this.handleSearch(initialValue);

        },
    }
}
</script>