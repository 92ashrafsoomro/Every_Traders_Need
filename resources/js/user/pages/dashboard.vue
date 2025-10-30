<template>
    <main>
        <TitleBar
            title="Dashboard Overview"
            subtitle="Monitor your stats and activities here"
        ></TitleBar>
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
