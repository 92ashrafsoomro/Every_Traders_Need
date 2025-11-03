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
                    <div>
                        <select name="years" id="years">
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="200">200</option>
                        </select>
                    </div>
                </div>
                <div class="rightElements">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Watchlist",
};
</script>

<style>
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

.leftElement {
    display: flex;
    align-items: center;
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
}
</style>
