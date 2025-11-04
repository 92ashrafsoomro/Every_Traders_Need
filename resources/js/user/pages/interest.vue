<template>
    <main>
        <TitleBar
            title="Personalized for You"
            subtitle="Save your interests to see matching auctions, stats, and valuations in one place."
        >
            <div class="btn-container">
                <a href="{{ url('/interest/create') }}" class="btn-primary">
                    Create Interest
                </a>
            </div>
        </TitleBar>
        <div class="p-4 mainDiv">
            <div class="mainContent">
                <div class="topLabel">
                    <div class="leftElements">
                        <div class="leftElement-Entries">
                            <div>Show Entries</div>
                            <select
                                class="entriesSelect"
                                name="entries"
                                id="entries"
                            >
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                        </div>
                        <div class="leftElement-Years">
                            <select class="yearsSelect" name="years" id="years">
                                <option value="All Years">All Years</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                            </select>
                        </div>
                    </div>
                    <div class="rightElements">
                        <div class="search-container">
                            <input type="text" placeholder="Search..." />
                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
                <DataTable />
            </div>
        </div>
    </main>
</template>

<script>
import TitleBar from "./../component/TitleBar.vue";
import DataTable from "./../component/dataTable.vue";

export default {
    props: {},
    components: {
        TitleBar,
        DataTable,
    },
};
</script>

<style scoped></style>
