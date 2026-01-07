<template>
    <v-dialog
    :model-value="dailog"
    @update:model-value=""
    width="600px"
    >
        <v-card
            prepend-icon="mdi-magnify"
            title="Make"
        >
        <v-card-text>
            <v-text-field v-model="search" @keyup.enter="handleSearch()"/>
                <ul class="mt-2">
                    <li v-if="loading" >Loading...</li>
                    <li class="text-center" v-if="data.length == 0" >No Record</li>
                    <li style="cursor: pointer;" v-else @click="selectValue(item)" class="py-3 px-2 mx-1 border" v-for="item in data">{{ item.id }} - {{ item.name }}</li>
                </ul>
        </v-card-text>
         <v-card-actions>
            <v-btn variant="flat" color="primary" @click="dailog = false;" >Close</v-btn>
         </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import Make from '@/models/make.model';




export default {
    name:"MakeModal",
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
               let res = await Make.all({ search: this.search ,length:10});
                this.data = res.data;
                this.loading = false;
            } catch (error) {
               this.loading = false;
               alert(error);
              
           }
        },
        async selectValue(item) {

            this.dailog = false;
            this.$emit('update:dailog',this.row,'make_id',item.name);
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