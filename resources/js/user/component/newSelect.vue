<template>
    <v-select
        clearable
        chips
        :label="label"
        :items="items"
        multiple
        variant="outlined"
    />
</template>
<script>
export default {
    name: "CustomSelect",
    props: {
        label: {
            type: String,
            default: "Select Option",
        },
        items: {
            type: Array,
            default: () => [
                "California",
                "Colorado",
                "Florida",
                "Georgia",
                "Texas",
                "Wyoming",
            ],
        },
    },
};
</script>

<style></style>
