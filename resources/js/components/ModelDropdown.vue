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
        :disabled="!make"
        @update:model-value="handleValue"
        clearable
    />  
</template>

<script>
import Model from "@/models/vehicle-model.model";

export default {
    name: "ModelDropdown",
    props: {
        modelValue: {
            type: [String, Number, Boolean],
            default: null
        },
        make: {
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
    watch: {
        make: {
            immediate: true, 
            handler(newValue) {
                this.getData();
            }
        }
    },
    methods: {
        async getData() {
            if (!this.make) {
                this.data = [];
                return;
            }

            this.loading = true;
            try {
                const response = await Model.all({
                    make_id: this.make,
                    length: 1000
                });
                this.data = response.data.sort((a, b) => a.name.localeCompare(b.name));
            } catch (err) {
                console.error("Error loading Models:", err);
                this.data = [];
            } finally {
                this.loading = false;
            }
        },
        handleValue(value) {
            this.$emit("update:modelValue", value); 
        },
    },
    emits: ['update:modelValue']
};
</script>

<style scoped>
</style>
