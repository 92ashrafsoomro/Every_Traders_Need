<template>
   <v-select
  v-bind="$attrs"
  :model-value="modelValue"
  :items="data"
  item-title="title"
  item-value="id"
  :loading="loading"
  @update:model-value="handleValue($event)"
/>
</template>

<script>
import Auction from "@/models/auction.model"



export default {
    name: "AuctionTypeDropdown",
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
        this.fetchPlatforms();
    },
    methods: {

        async fetchPlatforms() {
                this.loading = true;
                try {
                    const response = await Auction.auctionType({});
                    this.data = response.data; 
                } catch (err) {
                    console.error("Error loading platforms:", err);
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
    :deep(.v-field--active .v-field__outline),
    :deep(.v-field--focused .v-field__outline) {
    border-color: red !important;
    }
</style>