<template>
    <v-combobox
        clearable
        :label="label"
        :items="items"
        variant="outlined"
        :density="density"
    ></v-combobox>
</template>

<script>
export default {
    name: "ComoboxSelect",
    props: {
        density:{
            type: String,
            default: "default",
        },
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
