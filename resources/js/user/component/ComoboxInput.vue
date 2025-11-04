<template>
    <v-combobox
        clearable
        :label="label"
        :items="items"
        variant="outlined"
    ></v-combobox>
</template>

<script>
export default {
    name: "ComoboxSelect",
    props: {
        label: {
            type: String,
            default: "Select Options",
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
