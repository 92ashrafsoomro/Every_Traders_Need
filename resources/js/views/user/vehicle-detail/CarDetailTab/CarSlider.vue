<template>
    <div v-if="images">
        <v-responsive>
            <div>
                <v-img v-if="image.length" :src="image" class="rounded cursor-pointer" />

                <!-- Overlay Icon -->
                <v-btn icon size="small" class="d-flex position-absolute top-0 right-0 ma-2 rounded-sm  "
                    style="width: 40px; height: 40px;" @click.stop="openPreview">
                    <v-icon color="primary" size="30">mdi-fullscreen</v-icon>
                </v-btn>
            </div>



            <image-preview-carousel v-model="showPreview" :images="images" :startIndex="currentIndex" />

            <v-row class="d-flex justify-space-between ga-2 pa-5 align-center">

                <v-btn icon="mdi-chevron-left" variant="elevated" size="small" color="primary"
                    :disabled="currentIndex === 0" @click="prevImage" />

                <v-img v-for="(item, i) in visibleThumbs" :key="i" :src="item" width="60"
                    height="60"
                    class="border-sm d-lg-block d-md-block d-none rounded cursor-pointer"
                    @click="selectImage(item)" />


                <v-btn icon="mdi-chevron-right" variant="elevated" size="small" color="primary"
                    :disabled="currentIndex === images.length - 1" @click="nextImage" />

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
            showLimit: 6,
            showPreview: false,
            currentIndex: 0,
            thumbIndex: 0,
            thumbLimit: 6
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
        this.image = this.images[0]
        this.currentIndex = 0
    },

    methods: {
        prevImage() {
            if (this.currentIndex > 0) {
                this.currentIndex--
                this.image = this.images[this.currentIndex]
                this.syncThumbs()
            }
        },

        nextImage() {
            if (this.currentIndex < this.images.length - 1) {
                this.currentIndex++
                this.image = this.images[this.currentIndex]
                this.syncThumbs()
            }
        },

        selectImage(item) {
            this.image = item
            this.currentIndex = this.images.indexOf(item)
        },

        syncThumbs() {
            if (
                this.currentIndex < this.thumbIndex ||
                this.currentIndex >= this.thumbIndex + this.thumbLimit
            ) {
                this.thumbIndex = this.currentIndex
            }
        },

        openPreview() {
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