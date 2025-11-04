<template>
    <div class="position-relative w-100 h-auto bg-secondary pt-10 pb-8">
        <div class="pattern-bg"></div>
        <div
            class="position-relative ma-auto pt-5 ps-15 text-white text-left"
            style="max-width: 1590px; z-index: 10"
        >
            <h1 class="text-h3 mb-2 font-weight-bold">{{ title }}</h1>
            <p class="text-subtitle-1 mb-2 font-weight-medium">
                {{ subtitle }}
            </p>
            <slot> </slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "TitleBar",
    props: {
        title: {
            type: String,
            required: true,
        },
        subtitle: {
            type: String,
            default: "",
        },
    },
};
</script>

<style>
.pattern-bg {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px);
    background-size: 16px 16px;
    background-repeat: repeat;
    opacity: 0.25;
    pointer-events: none;
    z-index: 0;
}
</style>
