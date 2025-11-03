<template>
    <div class="p-4 mainDiv">
        <div class="mainContent">
            <div class="topLabel">
                <div class="leftElements">
                    <div class="leftElement-Entries">
                        <div>Show Entries</div>
                        <div>
                            <select name="entries" id="entries">
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                        </div>
                    </div>
                    <div class="leftElement-Years">
                        <select name="years" id="years">
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
                    <div><Select class="customSelect" /></div>
                    <div><Select class="customSelect" /></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Select from "./../../component/Select.vue";

export default {
    name: "Watchlist",
    components: {
        Select,
    },
};
</script>

<style>
.customSelect {
    --vs-background-color: #0f1c2b !important;
    --vs-text-color: #d3d3d3;
    --vs-placeholder-color: #d3d3d3;
    --vs-border: 1px solid #2b3b4f;
    --vs-menu-background-color: #0f1c2b !important;
    --vs-indicator-icon-color: white;
    --vs-option-text-color: white;
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

.leftElement-Entries select {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #2b3b4f;
    background-color: #1d2632;
    color: #d3d3d3;
    cursor: pointer;
}

.leftElement-Years select {
    padding: 5px 12px;
    border-radius: 5px;
    border: 1px solid #2b3b4f;
    background-color: #1d2632;
    color: #d3d3d3;
    cursor: pointer;
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
</style>
