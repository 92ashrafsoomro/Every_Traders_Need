<template>
    <v-select
        v-bind="$attrs"
        :model-value="statusValue"
        :items="data"
        item-title="name"
        item-value="id"
        :loading="loading"
        @update:model-value="handleStatus($event)"
    />
</template>

<script>
// import Platform from "@/models/platform.model";
import General from '@/models/general.model';
export default {
    name:'statusDrodown',
    
    props:{
        modelValue:{
            type:[String , Number , Boolean],
            default:null
        }
    },
    data(){
        return{
            value: null,
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
                // this.data.sort((a, b)=> a.name.localeCompare(b.name));
            } catch (error) {
                console.error("Error loading Status:", error)
            }finally{
                this.loading = false;
            }
        },
        handleStatus(value){
            this.$emit("update:modelValue", value)
        },
        emits:['update:modelValue']
    }

}
</script>

<style scoped>
    :deep(.v-field--active .v-field__outline),
:deep(.v-field--focused .v-field__outline) {
  border-color: red !important;
}
</style>