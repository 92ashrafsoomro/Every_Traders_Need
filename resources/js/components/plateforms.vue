<template>
    <v-combobox 
        v-model="value" 
        :items="platforms" 
        :search="search"
        item-title="label" 
        item-value="id" 
        label="Select Platform" 
        variant="outlined" 
        density="compact" 
        clearable
        no-filter
        :filter="() => true" 
        :loading="loading"
        @update:search="handleSearch"   
        placeholder="Type to search platforms..." 
        @update:model-value="handleSelect">

    </v-combobox>

    {{ value }}

    {{ search }}
</template>

<script>
import { getPlateforms } from "@/services/masterService";
import { debounce } from "lodash";

export default {
    name: "PlatformSelect",
    data() {
        return {
            search:'',
            value:null,
            selected: this.modelValue,
            platforms: [],
            loading: false,
        
        };
    },
    mounted() {
        // Load initial data (e.g. recent or all if no search)
        this.fetchPlatforms();
    },

    methods: {

        async fetchPlatforms(search = "") {

            this.loading = true;
            try {
                const response = await getPlateforms({
                    search: search.trim(),
                    length: 30,
                });
                this.platforms = response.data; 
            } catch (err) {
                console.error("Error loading platforms:", err);
                this.platforms = [];
            } finally {
                this.loading = false;
            }
        
        },
        handleSearch: debounce(function (val) {
            console.log("sea4rch",val);
            
        }, 300),

        handleSelect(value) {

            console.log('vvv',value);
            
            // this.$emit("update:modelValue", value);
        },
    },
};
</script>

<style scoped>
/* Optional: reduce height for compact look */
:deep(.v-field) {
    font-size: 0.875rem;
}
</style>