<template>
    <v-autocomplete
        v-bind="$attrs"
        :model-value="modelValue"
        :items="data"
        :loading="loading"
        @update:model-value="handleValue($event)"
        />  
</template>

<script>
import Model from "@/models/vehicle-model.model";

export default {
    name: "ModelDropdown",
    props: {
        modelValue: {
            type: [String, Number,Boolean],
            default: null
        },
        make: {
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
    mounted(){
      
    },
    watch: {
        make(newValue, oldValue) {
            this.getData()
        },
    },
    methods: {
        async getData() {
                if (!this.make) {
                    return false;    
                }
                this.loading = true;
                try {
                    const response = await Model.all({
                        make_id: this.make,
                        length: 1000
                    });
               
                    this.data = response.data; 
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
    },
    emits: ['update:value']
};
</script>

<style scoped>
    
</style>