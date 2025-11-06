<template>
    <main>
        <TitleBar title="Personalized for You"
            subtitle="Save your interests to see matching auctions, stats, and valuations in one place.">
            <v-btn append-icon="mdi-plus" color="primary" variant="flat" to="/create">
                Create Interest
            </v-btn>
        </TitleBar>
        <div class="pa-1 pa-sm-3 pt-6">
            <div class="mainContent mr-auto ml-auto">
                <div
                    class="d-flex flex-wrap align-start align-sm-center justify-space-between flex-column flex-sm-row ga-5">
                    <div class="leftElements d-flex align-center ga-3">
                        <v-select label="Year" :items="['2025', '2024', '2023', '2022', '2021', '2020']"
                            variant="outlined" color="primary" width="140" density="compact" clearable></v-select>
                    </div>
                    <div class="rightElements d-flex flex-wrap align-center ga-3">
                        <v-text-field label="Search..." prepend-inner-icon="mdi-magnify" density="compact" width="200"
                            variant="outlined" color="primary" clearable></v-text-field>
                    </div>
                </div>
                <DataTable />
            </div>
        </div>
    </main>
</template>

<script>
import TitleBar from "./../../component/TitleBar.vue";
import DataTable from "./../../component/dataTable.vue";

export default {
    props: {},
    components: {
        TitleBar,
        DataTable,
    },
};
</script>

<style scoped></style>
