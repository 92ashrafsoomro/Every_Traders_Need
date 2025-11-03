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
