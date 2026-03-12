<template>
    <div style="margin-top: 50px;">

        <div style=" position: sticky;
    top: 50px;
    z-index: 10;
    background: rgb(var(--v-theme-surface));
    border-bottom: 1px solid rgba(0,0,0,0.05);">
            <div class="mx-auto" style="   max-width: 1400px;
    padding: 5px 0;">
                <v-chip-group v-model="selectedCategory" mandatory>
                    <v-chip v-for="category in categories" :key="category.id" :value="category" color="primary"
                        variant="outlined" class="mr-3 text-capitalize">
                        {{ category.title }}
                    </v-chip>
                </v-chip-group>
            </div>
        </div>

        <div class="mx-auto mt-10" style="max-width: 1400px;">
            <h1 class="text-h4 font-weight-bold mb-6">Blog & articles</h1>
            <div v-if="featuredArticle" class=" rounded-lg d-flex d-flex-wrap ">
                <div class="">
                    <img :src="featuredArticle.image_preview" height="380" width="700" />

                </div>


                <div class="pl-10  d-flex flex-column  w-100" style="min-height: 380px;">

                    <!-- Text Content -->
                    <div>
                        <v-chip small color="primary" class="ma-3 text-caption font-weight-medium">
                            {{ featuredArticle.category?.title || 'General' }}
                        </v-chip>
                        <div class="text-h5 font-weight-bold pa-6">
                            {{ featuredArticle.title }}
                        </div>

                        <div class="pa-6 pt-0" v-html="truncateText(featuredArticle.description)">

                        </div>

                    </div>

                    <!-- Button Bottom -->
                    <div class="mt-auto pa-6 d-flex justify-space-between align-center ">

                        <div>
                            <router-link :to="`/blog/${featuredArticle.slug}`" style="text-decoration: none;">
                                <div class="button-hover d-flex justify-center align-center pa-3"
                                    style="min-width:120px; border-radius:40px;">
                                    <div class="text ml-2 mr-2">
                                        Read more
                                    </div>
                                </div>
                            </router-link>
                        </div>

                        <div style="display:flex; gap:12px;">

                            <div @click="prevArticle"
                                style="width:40px;height:40px;border-radius:50%;background:rgb(var(--v-theme-primary));display:flex;align-items:center;justify-content:center;cursor:pointer;">
                                <v-icon color="white">mdi-arrow-left</v-icon>
                            </div>

                            <div @click="nextArticle"
                                style="width:40px;height:40px;border-radius:50%;background:rgb(var(--v-theme-primary));display:flex;align-items:center;justify-content:center;cursor:pointer;">
                                <v-icon color="white">mdi-arrow-right</v-icon>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="bg-surface mt-12 py-12">
            <div class="mx-auto" style="max-width: 1400px;">


                <div class="d-flex align-center mb-6 pt-6">
                    <v-icon color="primary" left class="mr-2">mdi-lightbulb-outline</v-icon>
                    <h2 class="text-h5 font-weight-medium">Latest insights and trends</h2>
                </div>




                <v-row dense>
                    <v-col v-for="(item, i) in remainingArticles" :key="i" cols="12" md="4">
                        <div class="rounded-lg h-100 ml-2 d-flex flex-column mb-2 border" style="">

                            <div style="position:relative; overflow:hidden;" class="rounded-lg">

                                <v-img :src="item.image_preview || defultImage" height="180" cover />

                                <div style="position:absolute; inset:0; background: linear-gradient(to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5));"/>

                                <v-chip small color="primary" variant="elevated"
                                    class="ma-3 text-caption font-weight-medium"
                                    style="position:absolute; top:0; left:0;">
                                    {{ item.category?.title || 'General' }}
                                </v-chip>

                            </div>

                            <div class="pa-4">
                                <p class="text-subtitle-1 font-weight-medium py-3">
                                    {{ item.title }}
                                </p>

                                <p class="text-body-2 grey--text text--darken-1 flex-grow-1"
                                    v-html="truncateText(item.description, 20)">
                                </p>

                                <v-card-actions v-if="isLongText(item.description)" class="pb-4 px-4">
                                    <v-btn text color="primary" class="text-capitalize pa-0"
                                        @click="$router.push(`/blog/${item.slug}`)">
                                        Read more
                                    </v-btn>
                                </v-card-actions>

                            </div>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </div>
    </div>
</template>

<script>
import General from '@/models/general.model';
import defultImage from "@/assets/images/screen/darkBg.png"

export default {
    data() {
        return {
            selectedCategory: null,
            categories: [],
            defultImage,
            featuredArticle: null,
            remainingArticles: [],
            allArticles: [],
            currentIndex: 0,
            loading: false,
        };
    },
    mounted() {
        this.loadDashboard();
    },
    watch: {
        selectedCategory(newVal, oldVal) {
            if (newVal && newVal !== oldVal) {
                this.loadDashboard(newVal.id, null);
            }
        }
    },
    methods: {

        truncateText(text, wordlimit = 30) {
            if (!text) return '';
            const words = text.split(' ');
            if (words.length > wordlimit) {
                return words.slice(0, wordlimit).join(' ') + '...';
            }
            return text;
        },


        isLongText(text) {
            if (!text) return false;
            return text.split(' ').length > 20;
        },
        async loadDashboard(categoryId = null, blogId = null) {
            this.loading = true;
            try {

                const finalCategoryId = categoryId || (this.selectedCategory?.id || null);

                const params = {
                    category_id: finalCategoryId,
                    id: blogId
                };

                let res = await General.get("/api/web/getBlogDashboard", params);


                if (this.categories.length === 0) {
                    this.categories = [{ id: null, title: 'All' }, ...res.categories];

                    if (!this.selectedCategory) this.selectedCategory = this.categories[0];
                }

                this.featuredArticle = res.featured;
                this.remainingArticles = res.remaining;

                this.allArticles = [res.featured, ...res.remaining];
                this.currentIndex = 0;

                window.scrollTo({ top: 0, behavior: 'smooth' });

            } catch (error) {
                console.error("Dashboard load failed:", error);
            } finally {
                this.loading = false;
            }
        },
        nextArticle() {
            if (this.currentIndex < this.allArticles.length - 1) {
                this.currentIndex++;
                this.featuredArticle = this.allArticles[this.currentIndex];
            }
        },
        prevArticle() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
                this.featuredArticle = this.allArticles[this.currentIndex]
            }
        }
    }
};
</script>

<style scoped>
.v-chip-group {
    flex-wrap: wrap;
}

.v-card__title {
    line-height: 1.3;
}

.button-hover {
    background-color: transparent !important;
    border: 2px solid rgb(var(--v-theme-primary));
    color: rgb(var(--v-theme-primary));
    cursor: pointer;
}

.v-chip-group {
    flex-wrap: wrap;
}
</style>