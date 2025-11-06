<template>
    <main>
        <TitleBar title="Reauction Tracker"
            subtitle="Monitor unsold lots making a comeback — compare prices, bids, and market movement.">
            <div class="contentArea d-flex align-center justify-start
            pb-0 ga-6 mb-n6	mb-sm-n5">
                <div class="redBox d-flex align-center justify-center flex-column ga-2 bg-danger rounded-t-lg mb-n3">
                    <div class="redBox-figure text-h2 text-white">0</div>
                    <div class="redBox-date text-body-2 text-white">Today</div>
                </div>
                <div class="redBox-right d-flex align-center justify-center flex-column ga-1">
                    <div class="auction-house d-flex align-baseline justify-space-around ga-3">
                        <p class="text-white">Auction House</p>
                        <div class="wrapper">No Platforms</div>
                    </div>
                    <div class="auction-center d-flex align-baseline justify-space-around ga-5">
                        <p class="text-white">Auction Center</p>
                        <div class="wrapper">No Centers</div>
                    </div>
                </div>
            </div>
        </TitleBar>
        <div class="pa-4 pt-6">
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
                        <NewSelect label="Select Interest" density="compact" width="200" color="primary" />
                    </div>
                </div>
                <DataTable />
            </div>
        </div>
    </main>
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
.redBox {
    height: 116px;
    width: 75px;
}

.auction-house .wrapper {
    background-color: #0080ff40;
    color: #808080;
    font-size: 15px;
    font-weight: 400;
    padding: 5px;
    border-radius: 4px;
    flex-wrap: wrap;
}

.auction-center .wrapper {
    background-color: #0f1c2c;
    color: #808080;
    font-size: 15px;
    font-weight: 400;
    padding: 5px;
    border-radius: 4px;
    flex-wrap: wrap;
}

thead {
    white-space: nowrap;
}
</style>
