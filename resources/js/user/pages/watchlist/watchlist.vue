<template>
    <div class="p-4 mainDiv">
        <div class="mainContent mr-auto ml-auto">
            <div
                class="d-flex flex-wrap align-start align-sm-center justify-space-between flex-column flex-sm-row ga-5">
                <div class="leftElements d-flex align-center ga-3">
                    <v-select label="Year" :items="['2025', '2024', '2023', '2022', '2021', '2020']" variant="outlined"
                        color="primary" width="140" density="compact" clearable></v-select>
                </div>
                <div class="rightElements d-flex flex-wrap align-center ga-3">
                    <v-text-field label="Search..." prepend-inner-icon="mdi-magnify" density="compact" width="200"
                        variant="outlined" color="primary" clearable></v-text-field>
                    <NewSelect label="Select Interest" density="compact" width="200" color="primary" />
                </div>
            </div>
            <DataTable />
        </div>
    </div>
</template>

<script>
import NewSelect from "./../../component/newSelect.vue";
import DataTable from "../../component/dataTable.vue";
export default {
    name: "Watchlist",
    components: {
        NewSelect,
        DataTable,
    },
};
</script>

<style></style>
