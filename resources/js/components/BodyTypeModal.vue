<template>
    <v-dialog
    :model-value="dailog"
    @update:model-value=""
    width="600px"
    >
        <v-card
            prepend-icon="mdi-magnify"
            title="Body Type"
        >
         <v-card-actions class="" style="position: absolute; right: 10px; top: 8px;"> 
           <v-icon color="primary" @click="dailog = false;">mdi-close</v-icon>
         </v-card-actions>
        <v-card-text>
            <v-text-field v-model="search" @keyup.enter="handleSearch()"/>
                <ul class="mt-2">
                    <li v-if="loading" >Loading...</li>
                    <li class="text-center" v-if="data.length == 0" >No Record</li>
                    <li style="cursor: pointer;" v-else @click="selectValue(item)" class="py-3 px-2 mx-1 border" v-for="item in data">{{ item.id }} - {{ item.name }}</li>
                </ul>
        </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>
import BodyType from '@/models/body-type.model';


export default {
    name:"BodyTypeModal",
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
               let res = await BodyType.all({ search: this.search ,length:10});
                this.data = res.data;
                this.loading = false;
            } catch (error) {
               this.loading = false;
               alert(error);
              
           }
        },
        async selectValue(item) {

            this.dailog = false;
            this.$emit('update:dailog',this.row,'body_id',item.name);
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