<template>
    <div class="btn d-flex  align-center">
        <div class="pa-2 bg-primary rounded-xl text-subtitle-2 text-center" style="width: 100px;">
            {{ text }}
        </div>
        <v-btn icon color="white" class="circle-btn" :href="href" target="_blank"
            style="width: 30px; height: 30px; min-width: 30px; border-radius: 50%; ">
            <v-icon class="text-primary font-weight-bold">
                {{ icon }}
            </v-icon>
        </v-btn>
    </div>
</template>
<script>

export default {
    name: "AppButton",
    props: {
       
            href: {
                type: String,
                required: true
            },
        text: {
            type: String,
            default: "About Us"
        },
        icon: {
            type: String,
            default: "mdi-arrow-top-right"
        },
        to: {
            type: [String, Object],
            required: true
        }
    }
}


</script>
