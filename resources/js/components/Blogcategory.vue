<template>
  <v-select
    v-bind="$attrs"
    :items="data"
    item-title="title"
    item-value="id"
    :model-value="modelValue"
    :loading="loading"
    @update:model-value="$emit('update:modelValue', $event)"
  />
</template>

<script>
import General from '@/models/general.model';
export default {
    name: 'Blogcategory',

    props: {
        modelValue: {
            type: [Number, null],
            default: null
        }
    },

    data() {
        return {
            data: [],
            loading: false
        }
    },

    mounted() {
        this.fetchStatus()
    },

    watch: {
        type() {
            this.fetchStatus() 
        }
    },

    methods: {
        async fetchStatus() {
            this.loading = true;
            try {
                const response = await General.get(
                    "/api/cruds/blogCategory",
                    { type: this.type }
                );
                this.data = response.data;
                // this.data.sort((a,b)=>a.name.localeCompare(b.name));
            } catch (error) {
                console.error("Error loading categories:", error)
            } finally {
                this.loading = false;
            }
        },
        handleValue(value){
            this.$emit("update:modelValue" , value)
        }
    },
    emits:['update:modelValue']
}

</script>

<style scoped>
    :deep(.v-field--active .v-field__outline),
:deep(.v-field--focused .v-field__outline) {
  border-color: red !important;
}
</style>