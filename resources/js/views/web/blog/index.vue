<template>

 <div class="bg-surface d-flex align-center justify-center py-8 hero-section">
        <div class="mx-auto w-100 px-4" style="max-width:1400px;">

            <div v-if="featuredArticle" class="d-flex flex-column flex-md-row align-center ga-6">

                <!-- Image -->
                <div class="w-100 w-md-50">
                    <v-img :src="featuredArticle.image_preview" height="380" cover class="rounded-xl" />
                </div>

                <!-- Content -->
                <div class="d-flex flex-column w-100 w-md-50">

                    <div>
                        <h2 class="text-h4 font-weight-bold">
                            {{ featuredArticle.title }}
                        </h2>

                        <div class="pt-2 d-flex ga-2 align-center flex-wrap">
                            <v-chip size="small" class="rounded-lg text-caption">
                                {{ featuredArticle.category?.title || 'General' }}
                            </v-chip>

                            <span class="text-caption">
                                {{ dateFormate(featuredArticle.created_at) }}
                            </span>
                        </div>

                        <div class="mt-4">
                            {{ truncateText(featuredArticle.description) }}
                        </div>
                    </div>

                    <!-- Bottom -->
                    <div class="mt-6 d-flex justify-space-between align-center flex-wrap ga-3">

                        <router-link :to="`/blog/${featuredArticle.slug}`" style="text-decoration:none">
                            <div class="d-flex align-center justify-center pa-3 border rounded-pill text-primary " 
                                style="min-width:120px">
                                Read more
                            </div>
                        </router-link>

                        <div class="d-flex ga-3">

                            <v-btn icon color="primary" @click="prevArticle">
                                <v-icon color="white">mdi-arrow-left</v-icon>
                            </v-btn>

                            <v-btn icon color="primary" @click="nextArticle">
                                <v-icon color="white">mdi-arrow-right</v-icon>
                            </v-btn>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>


    <div class="bg-background py-12">

        <!-- Sticky Category Bar -->
        <div ref="stickyBar" :class="['sticky-bar', { 'sticky-active': isSticky }]">
            <div class="mx-auto px-4" style="max-width:1400px;">
                <v-chip-group v-model="selectedCategoryId" class="flex-wrap">
                    <v-chip v-for="category in categories" :key="category.id" :value="category.id" color="primary"
                        variant="outlined" class="mr-3 mb-2 text-capitalize">
                        {{ category.title }}
                    </v-chip>
                </v-chip-group>
            </div>
        </div>

        <div class="mx-auto px-4" style="max-width:1400px;">

            <!-- Title -->
            <div class="d-flex align-center my-6">
                <h1 class="text-h3 font-weight-bold">
                    {{ getCategoryTitle }}
                </h1>
            </div>

            <!-- Blog Grid -->
            <div class="d-flex flex-wrap ga-4">

                <div v-for="(item, i) in remainingArticles" :key="i" class="blog-card">

                    <div class="rounded-lg h-100 d-flex flex-column border"
                        style="background-color:rgb(var(--v-theme-surface),0.5);">

                        <!-- Image -->
                        <div class="position-relative overflow-hidden rounded-lg">

                            <v-img :src="item.image_preview || defultImage" height="180" cover />

                            <div
                                style="position:absolute; inset:0; background:linear-gradient(to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5));" />

                            <v-chip size="small" class="ma-3 rounded-lg text-caption font-weight-medium"
                                style="position:absolute; top:0; left:0;">
                                {{ item.category?.title || 'General' }}
                            </v-chip>

                        </div>

                        <!-- Content -->
                        <div class="pa-4">

                            <h4 class="text-h6 font-weight-bold py-3">
                                {{ item.title }}
                            </h4>

                            <p class="text-light_text_on" v-html="truncateText(item.description, 30)">
                            </p>

                            <div v-if="isLongText(item.description)">
                                <v-btn variant="text" color="primary" class="text-capitalize pa-0"
                                    @click="$router.push(`/blog/${item.slug}`)" style="text-decoration:underline">
                                    Read more
                                </v-btn>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</template>

<script>
import General from '@/models/general.model';
import defultImage from "@/assets/images/screen/darkBg.png"
import blogImage1 from "@/assets/images/Blog/image.png"

export default {
    data() {
        return {

            selectedCategoryId: null,
            categories: [],
            blogImage1,
            defultImage,
            isSticky: false,
            featuredArticle: null,
            remainingArticles: [],
            allArticles: [],
            currentIndex: 0,
            loading: false,
        };
    },
    computed: {
        getCategoryTitle() {
            if (this.selectedCategoryId === null) {
                return "All Articles";
            }
            const category = this.categories.find(c => c.id === this.selectedCategoryId);
            return category ? category.title : "All Articles";
        }
    },

    mounted() {
        this.loadDashboard();
        this.loadFeatured();
        this.selectedCategoryId = null;
        window.addEventListener("scroll", this.handleScroll);
    },

    beforeUnmount() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    watch: {
        selectedCategoryId(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.loadDashboard(newVal);
            }
        }
    },
    methods: {
        handleScroll() {
            const sticky = this.$refs.stickyBar;
            if (!sticky) return;
            const rect = sticky.getBoundingClientRect();
            this.isSticky = rect.top <= 50;
        },
        dateFormate(date) {
            if (!date) return ""
            return date?.split('T')[0].split(' ')[0]
        },
        truncateText(text, wordlimit = 30) {
            if (!text) return '';

            // Remove HTML tags
            const plainText = text.replace(/<\/?[^>]+(>|$)/g, "");

            const words = plainText.split(' ');
            if (words.length > wordlimit) {
                return words.slice(0, wordlimit).join(' ') + '...';
            }
            return plainText;
        },
        isLongText(text) {
            if (!text) return false;
            return text.split(' ').length > 20;
        },
        async loadDashboard(categoryId = null) {
            this.loading = true;
            try {

                const params = {
                    category_id: categoryId
                };

                let res = await General.get("/api/web/getBlogDashboard", params);

                this.categories = [{ id: null, title: 'All' }, ...res.categories];

                this.remainingArticles = res.remaining;

            } catch (error) {
                console.error("Dashboard load failed:", error);
            } finally {
                this.loading = false;
            }
        },
        async loadFeatured() {
            try {
                let res = await General.get("/api/web/getBlogDashboard");

                this.featuredArticle = res.featured;
                this.allArticles = [res.featured, ...res.remaining];
            } catch (error) {
                console.error(error);
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

.featured-wrapper {
    min-height: 60vh;
}

@media (max-width:960px) {

    .featured-wrapper {
        min-height: auto;
    }

}

.v-chip-group {
    flex-wrap: wrap;
}

.blog-card {
    width: 100%;
}

@media (min-width:960px) {
    .blog-card {
        width: calc(33.333% - 16px);
    }
}

@media (min-width:600px) and (max-width:959px) {
    .blog-card {
        width: calc(50% - 16px);
    }
}

.sticky-bar {
    position: sticky;
    top: 50px;
    background-color: rgb(var(--v-theme-background));
    z-index: 10;
    transition: border 0.2s ease;
}

.sticky-active {
    border-bottom: 1px solid rgba(var(--v-theme-border));
}
.hero-section {
  height: 80vh;
}

@media (max-width: 960px) {  
  .hero-section {
    height: 100vh;
  }
}
</style>