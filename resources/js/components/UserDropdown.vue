<template>
    <v-select
        v-bind="$attrs"
        :model-value="modelValue"
        :items="data"
        :loading="loading"
        @update:value="handleValue($event)"
        />  
</template>

<script>

import General from "@/models/general.model";

export default {
    name: "UserDropdown",
    props: {
        modelValue: {
            type: [String, Number,Boolean],
            default: null
        },
       
    },
    data() {
        return {
            value:null,
            data: [],
            loading: false,
        };
    },
    mounted(){
        this.get();
    },
    methods: {

        async get() {
                this.loading = true;
            try {
                    
                    const response = await General.get('/api/cruds/users',{});
                    this.data = response.data; 
                } catch (err) {
                    console.error("Error loading :", err);
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