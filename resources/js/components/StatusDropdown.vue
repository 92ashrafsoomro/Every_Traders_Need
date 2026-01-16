<template>
    <v-select
        v-bind="$attrs"
        :items="data"
        item-title="title"
        item-value="id"
        :loading="loading"
     
    />
</template>

<script>
// import Platform from "@/models/platform.model";
import General from '@/models/general.model';
export default {
    name:'statusDrodown',
    
    props:{
       
    },
    data(){
        return{
     
            data: [],
            loading: false
        }
    },
    mounted(){
        this.fetchStatus()
    },
    methods:{
        async fetchStatus(){
            this.loading = true;
            try {
                const response = await General.get("/api/cruds/auctionStatus",{});
                this.data = response.data;
                console.log("Auction Status " + this.data);
                
                //  this.data.sort((a,b)=>a.name.localeCompare(b.name));
            } catch (error) {
                console.error("Error loading Status:", error)
            }finally{
                this.loading = false;
            }
        },
      
    }

}
</script>

<style scoped>
    :deep(.v-field--active .v-field__outline),
:deep(.v-field--focused .v-field__outline) {
  border-color: red !important;
}
</style>