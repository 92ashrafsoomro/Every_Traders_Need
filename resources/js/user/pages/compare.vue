<template>
    <main>
        <TitleBar
            title="Find the Best Auction Deal"
            subtitle="Review and compare live auctions side by side to find the smartest deal."
        >
            <button id="filterToggle" class="filter-btn" @click="toggleFilters">
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
            </button>

            <!-- Filter Section -->
            <div id="filterSection" v-show="showFilters" class="filter-section">
                <div class="grid-container">
                    <div class="grid-item">
                        <label for="make">Make</label>
                        <Select class="customSelect"></Select>
                    </div>
                    <div class="grid-item">
                        <label for="make">Model</label>
                        <Select class="customSelect"></Select>
                    </div>
                    <div class="grid-item">
                        <label for="make">Variant</label>
                        <Select class="customSelect"></Select>
                    </div>
                    <div class="grid-item">
                        <label for="make">Year</label>
                        <Select class="customSelect"></Select>
                    </div>
                    <div class="grid-item">
                        <label for="make">Transmission</label>
                        <Select class="customSelect"></Select>
                    </div>
                    <div class="grid-item">
                        <label for="make">Fuel</label>
                        <Select class="customSelect"></Select>
                    </div>
                    <div class="grid-item">
                        <label for="make">Grade</label>
                        <Select class="customSelect"></Select>
                    </div>
                    <div class="grid-item">
                        <label for="make">Mileage</label>
                        <Select class="customSelect"></Select>
                    </div>
                    <div class="grid-item auctionHouse">
                        <label for="make">Auction House</label>
                        <MultipleSelect
                            class="customSelect-multiple"
                        ></MultipleSelect>
                    </div>
                    <div class="grid-item">
                        <button class="btn btn-primary searchBtn">
                            <span class="material-symbols-outlined">
                                search
                            </span>
                            <span class="btn-text">Search</span>
                        </button>
                    </div>
                </div>
            </div>
        </TitleBar>
    </main>
</template>

<script>
import TitleBar from "./../component/TitleBar.vue";
import Select from "./../component/Select.vue";
import MultipleSelect from "../component/MultipleSelect.vue";

export default {
    props: {},
    components: {
        TitleBar,
        Select,
        MultipleSelect,
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
.customSelect-multiple {
    margin-left: -11px !important;
    --vs-background-color: #000f21;
    --vs-text-color: white;
    --vs-placeholder-color: white;
    --vs-border: 1px solid #2b3b4f;
    --vs-menu-background-color: #000f21;
    --vs-indicator-icon-color: white;
    --vs-option-text-color: white;
    --vs-option-hover-background-color: #5796fa;
}

.customSelect {
    --vs-background-color: #000f21;
    --vs-text-color: white;
    --vs-placeholder-color: white;
    --vs-border: 1px solid #2b3b4f;
    --vs-menu-background-color: #000f21;
    --vs-indicator-icon-color: white;
    --vs-option-text-color: white;
    --vs-option-hover-background-color: #5796fa;
}

.multi-value {
    background-color: #5796fa !important;
    border: 1px solid #aaa !important;
}

.multi-value-label {
    color: white !important;
}

.multi-value button {
    background-color: #5796fa !important;
    color: white !important;
}

.multi-value-remove svg {
    color: white !important;
}

.filter-btn {
    display: flex;
    align-items: center;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: transparent;
    border: none;
}

.filter-btn span {
    margin-right: 8px;
    font-size: 1.125rem;
}
.icon {
    width: 16px;
    height: 16px;
    transition: transform 0.3s ease;
}
.icon.rotated {
    transform: rotate(180deg);
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    background-color: #000f21;
    padding: 15px;
    border: 1px solid #44485e;
    border-radius: 4px;
}

.grid-item {
    display: flex;
    flex-direction: column;
    column-gap: 5px;
    position: relative;
}
.auctionHouse {
    grid-column: span 2;
}
.searchBtn {
    display: flex !important;
    justify-content: center !important;
    align-items: self-end !important;
    column-gap: 5px;
    width: 108px;
    height: 36px;
    position: absolute;
    bottom: 3px;
}
.btn-text {
    font-size: 14px;
    font-weight: 500;
    color: white;
}

@media (max-width: 1024px) {
    .grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }
    .auctionHouse {
        grid-column: span 1;
    }

    .searchBtn {
        position: relative;
    }
}

@media (max-width: 767px) {
    .grid-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    .auctionHouse {
        grid-column: span 1;
    }
}

@media (max-width: 425px) {
    .grid-container {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
    }
    .auctionHouse {
        grid-column: span 1;
    }
}
</style>
