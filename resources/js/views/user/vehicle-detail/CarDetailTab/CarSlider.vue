<template>
    <div v-if="images">
        <v-responsive>
            <div>
                <v-img v-if="image" :src="image" class="rounded cursor-pointer" @click="openPreview" />

                <!-- Overlay Icon -->
                <v-btn icon  size="small" class=" position-absolute top-0 right-0 ma-2"
                    @click.stop="openPreview">
                    <v-icon color="primary">mdi-magnify-plus</v-icon>
                </v-btn>
            </div>



            <image-preview-carousel v-model="showPreview" :images="images" :startIndex="currentIndex" />

            <v-row class="ga-2 pa-5 align-center">

                <v-btn icon="mdi-chevron-left" variant="elevated" size="small"  color="primary" :disabled="thumbIndex === 0"
                    @click="thumbIndex--" >
                </v-btn>

                <v-img v-for="(item, i) in visibleThumbs" :key="i" :src="item" width="90" class="rounded cursor-pointer"
                    :class="{ 'active border': image === item }" @click="selectImage(item)" />

             
                <v-btn icon="mdi-chevron-right" variant="elevated" size="small"  color="primary"
                    :disabled="thumbIndex + thumbLimit >= images.length" @click="thumbIndex++" />

            </v-row>



        </v-responsive>
    </div>
</template>

<script>
import { useVehicleStore } from '@/stores/vehicleStore';

import ImagePreviewCarousel from '../../auction-finder/sidebar/fields/ImagePreviewCarousel.vue';

export default {
    components: {

        ImagePreviewCarousel
    },
    data() {
        return {
            vehicleStore: useVehicleStore(),
            image: '',
            showLimit: 4,
            showPreview: false,
            currentIndex: 0,
            thumbIndex: 0,
            thumbLimit: 4
        };
    },

    computed: {
        images() {
            return this.vehicleStore.vehicle?.images?.split(",") || [];
        },

        visibleItems() {
            return this.images.slice(0, this.showLimit);
        },
        thumbnailSlides() {
            const chunkSize = 4;
            const chunks = [];

            for (let i = 0; i < this.images.length; i += chunkSize) {
                chunks.push(this.images.slice(i, i + chunkSize));
            }

            return chunks;
        },
        visibleThumbs() {
            return this.images.slice(
                this.thumbIndex,
                this.thumbIndex + this.thumbLimit
            );
        }

    },

    mounted() {
        this.image = this.images[0];
    },

    methods: {
        selectImage(item) {
            this.image = item;
        },
        openPreview() {
            this.currentIndex = this.image.indexOf(this.image);
            this.showPreview = true
        }
    }
};
</script>

<style scoped>
.active {
    border-color: rgb(var(--v-theme-primary)) !important;
}

.cursor-pointer {
    cursor: pointer;
}

.active {
    border: 2px solid rgb(var(--v-theme-primary));
}
</style>