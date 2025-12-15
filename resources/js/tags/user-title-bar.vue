<template>
    <div class="position-relative w-100 bg-surface h-auto pt-10 pb-8">
        <div class="pattern-bg"></div>
        <div class="position-relative  pt-5  mx-auto px-2 px-lg-4 " style=" max-width: 1400px; z-index: 10">
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
    name: "user-title-bar",
    props: {
        title: {
            type: String,
            default:"",
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
