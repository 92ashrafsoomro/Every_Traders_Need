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
    </main>
</template>

<script>
import TitleBar from "./../component/TitleBar.vue";

export default {
    props: {},
    components: {
        TitleBar,
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
</style>
