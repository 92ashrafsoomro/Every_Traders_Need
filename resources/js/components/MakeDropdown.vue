<template>
    <v-autocomplete
        v-bind="$attrs"
        :model-value="modelValue"
        :items="data"
        :loading="loading"
        density="compact"
        variant="outlined"
        item-title="name"
        item-value="id"
        @update:model-value="handleValue"
    />  
</template>

<script>
import Make from "@/models/make.model";

export default {
    name: "MakeSelect",
    props: {
        modelValue: {
            type: [String, Number, Boolean],
            default: null
        },       
    },
    data() {
        return {
            data: [],
            loading: false,
        };
    },
    mounted() {
        this.fetchMakes();
    },
    methods: {
        async fetchMakes() {
            this.loading = true;
            try {
                const response = await Make.all({ length: 1000 });
                this.data = response.data.sort((a,b)=> a.name.localeCompare(b.name));
            } catch (err) {
                console.error("Error loading Makes:", err);
                this.data = [];
            } finally {
                this.loading = false;
            }
        },
        handleValue(value) {
            this.$emit("update:modelValue", value); // 🔹 Correct
        },
    },
    emits: ['update:modelValue'],
};
</script>

<style scoped>
    
</style>