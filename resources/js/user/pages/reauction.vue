<template>
    <TitleBar title="Reauction Tracker"
        subtitle="Monitor unsold lots making a comeback — compare prices, bids, and market movement.">
        <v-container class="contentArea d-flex align-center justify-start pb-0 ga-6 mb-n6 mb-sm-n5" fluid>
            <v-card class="redBox d-flex align-center justify-center flex-column ga-2 bg-danger rounded-t-lg mb-n3"
                elevation="0">
                <v-card-title class="redBox-figure text-h2 text-white">0</v-card-title>
                <v-card-subtitle class="redBox-date text-body-2 text-white">Today</v-card-subtitle>
            </v-card>

            <v-card color="transparent" class="d-flex align-center justify-center flex-column ga-1" elevation="0">
                <v-row class="auction-house d-flex align-baseline justify-space-around ga-1 ga-sm-3" align="baseline">
                    <v-col cols="auto">
                        <p>Auction House</p>
                    </v-col>
                    <v-col cols="auto">
                        <div class="wrapper bg-shadow pa-3 rounded flex-wrap">No Platforms</div>
                    </v-col>
                </v-row>

                <v-row class="auction-center d-flex align-baseline justify-space-around ga-5" align="baseline">
                    <v-col cols="auto">
                        <p>Auction Center</p>
                    </v-col>
                    <v-col cols="auto">
                        <div class="wrapper bg-shadow pa-3 rounded flex-wrap">No Centers</div>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>
    </TitleBar>


    <v-container class="pa-4 pt-6" fluid>
        <v-container class="mainContent mr-auto ml-auto" fluid>
            <v-row
                class="d-flex flex-wrap align-start align-sm-center justify-space-between flex-column flex-sm-row ga-5">
                <!-- LEFT ELEMENTS -->
                <v-col class="leftElements d-flex align-center ga-3" cols="12" sm="auto">
                    <v-select label="Year" :items="['2025', '2024', '2023', '2022', '2021', '2020']" variant="outlined"
                        color="primary" width="140" density="compact" clearable />
                </v-col>

                <!-- RIGHT ELEMENTS -->
                <v-col class="rightElements d-flex flex-wrap align-center ga-3" cols="12" sm="auto">
                    <v-text-field label="Search..." prepend-inner-icon="mdi-magnify" density="compact" width="200"
                        variant="outlined" color="primary" clearable />
                    <NewSelect label="Select Interest" density="compact" width="200" color="primary" />
                </v-col>
            </v-row>

            <DataTable />
        </v-container>
    </v-container>

</template>

<script>
import TitleBar from "./../component/TitleBar.vue";
import Select from "./../component/Select.vue";
import DataTable from "./../component/dataTable.vue";
import NewSelect from "../component/newSelect.vue";

export default {
    props: {},
    components: {
        TitleBar,
        Select,
        DataTable,
        NewSelect,
    },
};
</script>

<style>
thead {
    white-space: nowrap;
}
</style>
