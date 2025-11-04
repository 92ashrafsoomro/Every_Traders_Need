<template>
    <main>
        <TitleBar
            title="Reauction Tracker"
            subtitle="Monitor unsold lots making a comeback — compare prices, bids, and market movement."
        >
            <div class="contentArea">
                <div class="redBox">
                    <div class="redBox-figure">0</div>
                    <div class="redBox-date">Today</div>
                </div>
                <div class="redBox-right">
                    <div class="auction-house">
                        <p>Auction House</p>
                        <div class="wrapper">No Platforms</div>
                    </div>
                    <div class="auction-center">
                        <p>Auction Center</p>
                        <div class="wrapper">No Centers</div>
                    </div>
                </div>
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
                        <div class="customSelect-container">
                            <div>
                                <Select
                                    class="customSelect"
                                    placeholder="Select Interest"
                                    :options="[
                                        { label: 'BMW', value: 'bmw' },
                                        { label: 'Audi', value: 'audi' },
                                        {
                                            label: 'Mercedes',
                                            value: 'mercedes',
                                        },
                                    ]"
                                />
                            </div>
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
import Select from "./../component/Select.vue";
import DataTable from "./../component/dataTable.vue";

export default {
    props: {},
    components: {
        TitleBar,
        Select,
        DataTable,
    },
};
</script>

<style>
.contentArea {
    display: flex;
    align-items: center;
    justify-content: start;
    padding-bottom: 0px;
    column-gap: 25px;
    margin-bottom: -20px;
}

.redBox {
    height: 116px;
    width: 75px;
    background-color: #b91c1c;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    column-gap: 8px;
}

.redBox-figure {
    font-size: 48px;
    font-weight: 700;
    color: white;
}

.redBox-date {
    font-size: 15px;
    font-weight: 400;
    color: #b2c0ce;
}

.redBox-right {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    column-gap: 4px;
}

.auction-house {
    display: flex;
    align-items: baseline;
    justify-content: space-around;
    column-gap: 10px;
}

.auction-center {
    display: flex;
    align-items: baseline;
    justify-content: space-around;
    column-gap: 20px;
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

.auction-house p {
    font-size: 15px;
    font-weight: 400;
    color: white;
}

.auction-center p {
    font-size: 15px;
    font-weight: 400;
    color: white;
}

@media (max-width: 320px) {
    .contentArea {
        margin-bottom: -28px;
    }
}

.dataTable {
    background-color: #000f21;
    color: white;
    border: 1px solid #e5e7eb30;
    border-radius: 4px;
    margin-top: 20px;
}

thead {
    white-space: nowrap;
}

.customSelect {
    --vs-background-color: #0f1c2b !important;
    --vs-text-color: #d3d3d3;
    --vs-placeholder-color: #d3d3d3;
    --vs-border: 1px solid #2b3b4f;
    --vs-menu-background-color: #0f1c2b !important;
    --vs-indicator-icon-color: white;
    --vs-option-text-color: white;
    --vs-menu-border: 1px solid #2b3b4f;
}

.mainDiv {
    background-color: #0f1c2b;
    color: #d3d3d3;
}

.mainContent {
    max-width: 1536px;
    padding: 0 24px;
    margin-left: auto;
    margin-right: auto;
}

.topLabel {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.leftElements {
    display: flex;
    align-items: center;
    column-gap: 10px;
}

.leftElement-Years {
    display: flex;
    align-items: center;
    column-gap: 10px;
    font-size: 15px;
    font-weight: 400;
    color: #d3d3d3;
}

.leftElement-Entries {
    display: flex;
    align-items: center;
    column-gap: 10px;
    font-size: 15px;
    font-weight: 400;
    color: #d3d3d3;
}

.entriesSelect {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #44485e;
    background-color: #1d2632;
    color: #d3d3d3;
    cursor: pointer;
}

.entriesSelect:focus {
    border: 2px solid #0080ff;
    outline: none;
}

.yearsSelect {
    padding: 5px 12px;
    border-radius: 5px;
    border: 1px solid #44485e;
    background-color: #1d2632;
    color: #d3d3d3;
    cursor: pointer;
}

.yearsSelect:focus {
    border: 2px solid #0080ff;
    outline: none;
}

.rightElements {
    display: flex;
    align-items: center;
    column-gap: 10px;
}

.search-container {
    position: relative;
    width: 200px;
}

.search-container input {
    width: 100%;
    padding: 6px 38px;
    border: 1px solid #44485e;
    border-radius: 6px;
    font-size: 16px;
    outline: none;
    transition: all 0.2s ease;
    background-color: #0f1c2b;
    color: #d3d3d3;
}

.search-container input:focus {
    border: 2px solid #0080ff;
}

.search-container svg {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    stroke: #aab8c5;
    pointer-events: none;
    transition: stroke 0.2s ease;
}

.customSelect-container {
    display: flex;
    align-items: center;
    column-gap: 10px;
}

@media (max-width: 950px) {
    .topLabel {
        display: flex;
        flex-direction: column;
        align-items: start;
        row-gap: 20px;
        width: 100%;
    }
    .leftElements {
        display: flex;
        align-items: center;
        justify-content: baseline;
        column-gap: 10px;
    }
}

@media (max-width: 666px) {
    .mainContent {
        padding: 0 5px;
        margin-left: auto;
        margin-right: auto;
    }

    .topLabel {
        display: flex;
        flex-direction: column;
        align-items: start;
        row-gap: 20px;
        width: 100%;
    }

    .rightElements {
        display: flex;
        flex-direction: column;
        align-items: start;
        row-gap: 20px;
        width: inherit;
    }

    .search-container {
        position: relative;
        width: 100%;
    }
}
</style>
