<template>
    <v-autocomplete
        v-bind="$attrs"
        :model-value="modelValue"
        :items="data"
        :loading="loading"
        density="compact"
        variant="outlined"
        @update:model-value="handleValue($event)"
        />  
</template>

<script>
import Make from "@/models/make.model";

export default {
    name: "MakeSelect",
    props: {
        modelValue: {
            type: [String, Number,Boolean],
            default: null
        },       
    },
    data() {
        return {
            data: [],
            loading: false,
        };
    },
    watch:{  
        modelValue:{
            immediate: true,
            handler(newValue,oldValue){
                console.log('new',newValue);
                
            }
        }
    },
    mounted(){
        this.fetchPlatforms();
    },
    methods: {

        async fetchPlatforms() {
                this.loading = true;
                try {
                    const response = await Make.all({length:1000});
                    this.data = response.data; 
                       this.data.sort((a,b)=>a.name.localeCompare(b.name));
                } catch (err) {
                    console.error("Error loading Makes:", err);
                    this.data = [];
                } finally {
                    this.loading = false;
                }
        },
        handleValue(value) {
            this.$emit("update:value", value);
        },
        onEnter() {
          
        },
        
    },
    emits: ['update:value']
};
</script>

<style scoped>
    
</style>