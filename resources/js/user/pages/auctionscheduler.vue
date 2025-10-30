<template>
    <main>
        <TitleBar
            title="Auction Scheduler"
            subtitle="Manage and view platform auctions across all centers in one place."
        >
            <div class="selectContainer">
                <Dropdown />
            </div>
        </TitleBar>
    </main>
</template>

<script>
import TitleBar from "./../component/TitleBar.vue";
import Dropdown from "./../component/Select.vue";

export default {
    props: {},
    components: {
        TitleBar,
        Dropdown,
    },
};
</script>

<style scoped>
.selectContainer {
    display: flex;
    align-items: center;
    gap: 20px;
}

.schedulerSelect {
    padding: 5px 10px;
}
</style>
