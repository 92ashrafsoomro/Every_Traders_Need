<template>
    <main>
        <TitleBar
            title="Auction Scheduler"
            subtitle="Manage and view platform auctions across all centers in one place."
        >
            <div class="selectContainer">
                <CustomSelect
                    class="customSelect"
                    placeholder="Select Platform"
                    :options="[
                        { label: 'Option #1', value: 'option_1' },
                        { label: 'Option #2', value: 'option_2' },
                        { label: 'Option #3', value: 'option_3' },
                    ]"
                />

                <CustomSelect
                    class="customSelect"
                    placeholder="Select Center"
                    :options="[
                        { label: 'Option #1', value: 'option_1' },
                        { label: 'Option #2', value: 'option_2' },
                        { label: 'Option #3', value: 'option_3' },
                    ]"
                />
                <div>
                    <label class="switch">
                        <input type="checkbox" />
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <div class="scheduleContainer">
                <div class="scheduleDiv">
                    <div class="upperSection">Today</div>
                    <div class="lowerSection">
                        <div>
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv">
                    <div class="upperSection">Today</div>
                    <div class="lowerSection">
                        <div>
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv">
                    <div class="upperSection">Today</div>
                    <div class="lowerSection">
                        <div>
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv">
                    <div class="upperSection">Today</div>
                    <div class="lowerSection">
                        <div>
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv">
                    <div class="upperSection">Today</div>
                    <div class="lowerSection">
                        <div>
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv">
                    <div class="upperSection">Today</div>
                    <div class="lowerSection">
                        <div>
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="scheduleDiv">
                    <div class="upperSection">Today</div>
                    <div class="lowerSection">
                        <div>
                            <small><i class="fa-solid fa-gavel"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small> <i class="fa-solid fa-car"></i></small>
                            <span>0</span>
                        </div>
                        <div>
                            <small><i class="fa-solid fa-heart"></i></small>
                            <span>0</span>
                        </div>
                    </div>
                </div>
            </div>
        </TitleBar>
        <div class="mainContent">
            <DataTable />
        </div>
    </main>
</template>

<script>
import TitleBar from "./../component/TitleBar.vue";
import CustomSelect from "./../component/Select.vue";
import DataTable from "./../component/dataTable.vue";

export default {
    props: {},
    components: {
        TitleBar,
        CustomSelect,
        DataTable,
    },
};
</script>

<style scoped>
.mainContent {
    max-width: 1536px;
    padding: 0 24px;
    margin-left: auto;
    margin-right: auto;
}

.customSelect {
    --vs-background-color: #1a2533;
    --vs-text-color: white;
    --vs-placeholder-color: white;
    --vs-border: 1px solid #2b3b4f;
    --vs-menu-background-color: #1a2533;
    --vs-indicator-icon-color: white;
    --vs-option-text-color: white;
}

.selectContainer {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 45%;
}

.schedulerSelect {
    padding: 5px 10px;
}

.switch {
    font-size: 17px;
    position: relative;
    display: inline-block;
    width: 3em;
    height: 1.6em;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    border: 2px solid #414141;
    border-radius: 50px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.slider:before {
    position: absolute;
    content: "";
    height: 1em;
    width: 1em;
    left: 0.2em;
    bottom: 0.2em;
    background-color: white;
    border-radius: inherit;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

.switch input:checked + .slider {
    box-shadow: 0 0 20px rgba(9, 117, 241, 0.8);
    border: 2px solid #0974f1;
}

.switch input:checked + .slider:before {
    transform: translateX(1.5em);
}

.scheduleContainer {
    padding-top: 15px;
    display: flex;
    align-items: center;
    column-gap: 15px;
    flex-wrap: wrap;
}

.scheduleDiv {
    height: 95px;
    width: 195px;
    border: 1px solid #2b3b4f;
    border-radius: 4px;
    background-color: #0f1c2b;
    padding: 10px 18px;
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

.upperSection {
    color: white;
    font-size: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid #2b3b4f;
    padding: 10px;
}

.lowerSection {
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
}

.lowerSection div span {
    font-size: 11px;
    font-weight: 600;
    color: #cccccc;
    margin-left: 4px;
}

.lowerSection div:nth-child(1) {
    display: flex;
    align-items: center;
    color: #0080ff;
    font-size: 10px;
}

.lowerSection div:nth-child(2) {
    display: flex;
    align-items: center;
    color: #00bad1;
    font-size: 10px;
}

.lowerSection div:nth-child(3) {
    display: flex;
    align-items: center;
    color: #ff4c51;
    font-size: 10px;
}

@media (max-width: 1024px) {
    .selectContainer {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
    }
}

@media (max-width: 768px) {
    .scheduleContainer {
        margin-left: auto;
        margin-right: auto;
    }

    .scheduleDiv {
        height: auto;
        width: 183px;
    }

    .upperSection {
        padding: 6px;
    }

    .selectContainer {
        display: flex;
        flex-direction: column;
        align-items: start;
        gap: 10px;
        width: 100%;
    }
}

@media (max-width: 375px) {
    .scheduleDiv {
        height: auto;
        width: 160px;
    }
}

@media (max-width: 320px) {
    .scheduleDiv {
        height: auto;
        width: 130px;
    }
}
</style>
