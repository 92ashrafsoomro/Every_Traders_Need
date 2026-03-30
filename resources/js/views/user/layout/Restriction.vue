<template>

    <div class="center-wrapper">
        <div class=" pa-4 box">
            <p>Upgrade to Your Plan The Current plan not supported this page..</p>
            <div class="mt-2">
                <v-btn color="primary" to="/user/settings/billing">
                Upgrade Plan
            </v-btn>

            <v-btn variant="text" @click="$router.back()">
                Go Back
            </v-btn>
            </div>
        </div>
    </div>

</template>

<script>
</script>


<style scoped>
.center-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    height: 80vh;
}
</style>