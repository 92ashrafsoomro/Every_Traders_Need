<template>
    <div class="container">
        <VueSelect
            v-model="selected"
            :is-multi="true"
            :options="[
                { label: 'Option #1', value: 'option_1' },
                { label: 'Option #2', value: 'option_2' },
                { label: 'Option #3', value: 'option_3' },
            ]"
            placeholder="Select options"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import VueSelect from "vue3-select-component";
import "vue3-select-component/styles";

const selected = ref([]);
</script>

<style></style>
