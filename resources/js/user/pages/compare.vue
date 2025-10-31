<template>
    <main>
        <TitleBar
            title="Find the Best Auction Deal"
            subtitle="Review and compare live auctions side by side to find the smartest deal."
        >
            Filter <span></span>
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

<style scoped></style>
