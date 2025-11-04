<template>
    <main>
        <TitleBar
            title="Find the Best Auction Deal"
            subtitle="Review and compare live auctions side by side to find the smartest deal."
        >
            <v-btn
                id="filterToggle"
                variant="flat"
                class="d-flex align-center text-white cursor-pointer bg-transparent border-0 text-capitalize font-weight-light"
                @click="toggleFilters"
            >
                <span class="mr-2">Filters</span>
                <svg
                    id="filterIcon"
                    class="icon"
                    :class="{ rotated: showFilters }"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    ></path>
                </svg>
            </v-btn>

            <!-- Filter Section -->
            <div class="flex justify-start align-start" v-show="showFilters">
                <v-container
                    fluid
                    class="pa-6 bg-secondary rounded border border-[#44485e] w-[90%] mt-2"
                    style="margin-left: -1px"
                >
                    <v-row dense>
                        <!-- Make -->
                        <v-col cols="12" sm="6" md="3">
                            <v-combobox
                                label="Select Make"
                                :items="['Toyota', 'Honda', 'Nissan', 'Suzuki']"
                                variant="outlined"
                                density="comfortable"
                                clearable
                                color="primary"
                            />
                        </v-col>

                        <!-- Model -->
                        <v-col cols="12" sm="6" md="3">
                            <v-combobox
                                label="Model"
                                :items="[
                                    'Corolla',
                                    'Civic',
                                    'Skyline',
                                    'Swift',
                                ]"
                                variant="outlined"
                                density="comfortable"
                                clearable
                                color="primary"
                            />
                        </v-col>

                        <!-- Variant -->
                        <v-col cols="12" sm="6" md="3">
                            <v-combobox
                                label="Select Variant"
                                :items="['Base', 'GLI', 'XLI', 'RS']"
                                variant="outlined"
                                density="comfortable"
                                clearable
                                color="primary"
                            />
                        </v-col>

                        <!-- Year -->
                        <v-col cols="12" sm="6" md="3">
                            <v-combobox
                                label="Select Year"
                                :items="[
                                    '2018',
                                    '2019',
                                    '2020',
                                    '2021',
                                    '2022',
                                ]"
                                variant="outlined"
                                density="comfortable"
                                clearable
                                color="primary"
                            />
                        </v-col>

                        <!-- Transmission -->
                        <v-col cols="12" sm="6" md="3">
                            <v-combobox
                                label="Transmission"
                                :items="['Automatic', 'Manual']"
                                variant="outlined"
                                density="comfortable"
                                clearable
                                color="primary"
                            />
                        </v-col>

                        <!-- Fuel -->
                        <v-col cols="12" sm="6" md="3">
                            <v-combobox
                                label="Select Fuel"
                                :items="[
                                    'Petrol',
                                    'Diesel',
                                    'Hybrid',
                                    'Electric',
                                ]"
                                variant="outlined"
                                density="comfortable"
                                clearable
                                color="primary"
                            />
                        </v-col>

                        <!-- Grade -->
                        <v-col cols="12" sm="6" md="3">
                            <v-combobox
                                label="Select Grade"
                                :items="['A', 'B', 'C', 'S']"
                                variant="outlined"
                                density="comfortable"
                                clearable
                                color="primary"
                            />
                        </v-col>

                        <!-- Mileage -->
                        <v-col cols="12" sm="6" md="3">
                            <v-combobox
                                label="Select Mileage Range"
                                :items="[
                                    '0-10k',
                                    '10k-50k',
                                    '50k-100k',
                                    '100k+',
                                ]"
                                variant="outlined"
                                density="comfortable"
                                clearable
                                color="primary"
                            />
                        </v-col>

                        <!-- Auction House -->
                        <v-col cols="12" sm="6" md="3">
                            <NewSelect />
                        </v-col>

                        <!-- Search Button -->
                        <v-col
                            cols="12"
                            sm="6"
                            md="3"
                            class="d-flex align-center mb-6"
                        >
                            <v-btn
                                prepend-icon="mdi-magnify"
                                variant="tonal"
                                color="primary"
                            >
                                Search
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </div>
        </TitleBar>
    </main>
</template>

<script>
import TitleBar from "./../component/TitleBar.vue";
import Select from "./../component/Select.vue";
import MultipleSelect from "../component/MultipleSelect.vue";
import NewSelect from "../component/newSelect.vue";
import ComoboxInput from "../component/ComoboxInput.vue";

export default {
    props: {},
    components: {
        TitleBar,
        Select,
        MultipleSelect,
        NewSelect,
        ComoboxInput,
    },

    name: "FilterToggle",
    data() {
        return {
            showFilters: false,
        };
    },
    methods: {
        toggleFilters() {
            this.showFilters = !this.showFilters;
        },
    },
};
</script>

<style>
.icon {
    width: 16px;
    height: 16px;
    transition: transform 0.3s ease;
}
.icon.rotated {
    transform: rotate(180deg);
}
</style>
