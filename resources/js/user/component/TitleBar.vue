<template>
    <div class="hero-section">
        <div class="pattern-bg"></div>

        <div class="content">
            <h1>{{ title }}</h1>
            <p>
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
.hero-section {
    position: relative;
    width: 100%;
    height: auto;
    background-color: #000f21;
    padding: 40px 0;
    padding-bottom: 0px;
}

.pattern-bg {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px);
    background-size: 16px 16px;
    opacity: 0.25;
    pointer-events: none;
    z-index: 0;
}

.content {
    position: relative;
    z-index: 10;
    margin: 0 auto;
    padding: 20px 60px;
    color: white;
    text-align: left;
    margin-right: auto;
    margin-left: auto;
    max-width: 1590px;
}

.content h1 {
    font-size: 48px;
    font-weight: 700;
}

.content p {
    font-size: 18px;
    font-weight: 400;
    color: #b1bfcd;
}

.btn-primary {
    display: inline-block;
    background-color: #0080ff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 4px;
    font-weight: 600;
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #0066cc;
}

@media (max-width: 768px) {
    .content {
        padding: 20px 15px;
    }
}
</style>
