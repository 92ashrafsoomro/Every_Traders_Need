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
import General from '@/models/general.model';
export default {
    name: 'Blogcategory',

    props: {
        type: {
            type: String,
            default: 'blog' 
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
            } catch (error) {
                console.error("Error loading categories:", error)
            } finally {
                this.loading = false;
            }
        }
    }
}

</script>

<style scoped>
    :deep(.v-field--active .v-field__outline),
:deep(.v-field--focused .v-field__outline) {
  border-color: red !important;
}
</style>