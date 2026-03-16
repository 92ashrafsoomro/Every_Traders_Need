<template>


    <div class="bg-surface d-flex align-center justify-center" style="height: 80vh;">
        <div class="mx-auto py-10 mt-12" style="max-width: 1400px;">

            <div v-if="featuredArticle" class="  d-flex d-flex-wrap ">
                <div style="border-radius: 14px !important;">
                    <img :src="featuredArticle.image_preview" height="380" width="700" class="rounded-xl" />
                </div>


                <div class="pl-10  d-flex flex-column  w-100" style="min-height: 380px;">

                    <!-- Text Content -->
                    <div class="px-6">
                        <h2 class="text-h4 font-weight-bold ">
                            {{ featuredArticle.title }}
                        </h2>
                        <div class="pt-2 d-flex ga-2 align-center">

                            <v-chip small class="rounded-lg  text-caption font-weight-medium">
                                {{ featuredArticle.category?.title || 'General' }}
                            </v-chip>
                            <span class="text-caption font-weight-medium">{{ dateFormate(featuredArticle.created_at)
                            }}</span>

                        </div>
                        <div class=" mt-6" v-html="truncateText(featuredArticle.description)">

                        </div>

                    </div>

                    <!-- Button Bottom -->
                    <div class="mt-auto px-6 d-flex justify-space-between align-center ">

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
    </div>





    <div class="bg-background  py-12">

        <div ref="stickyBar" :class="['sticky-bar', { 'sticky-active': isSticky }]">
            <div class="mx-auto" style="   max-width: 1400px;
            padding: 5px 0;">
                <v-chip-group v-model="selectedCategoryId" mandatory>
                    <v-chip v-for="category in categories" :key="category.id" :value="category.id" color="primary"
                        variant="outlined" class="mr-3 text-capitalize">
                        {{ category.title }}
                    </v-chip>
                </v-chip-group>
            </div>
        </div>
        <div class="mx-auto " style="max-width: 1400px;">

            <div class="d-flex align-center my-6">
                <h1 class="text-h3 font-weight-bold"> {{ getCategoryTitle }}</h1>
            </div>

            <v-row dense>
                <v-col v-for="(item, i) in remainingArticles" :key="i" cols="12" md="4">
                    <div class="rounded-lg h-100 ml-2 d-flex flex-column mb-2 border"
                        style="background-color: rgb(var(--v-theme-surface),0.5);">

                        <div style="position:relative; overflow:hidden;" class="rounded-lg">

                            <v-img :src="item.image_preview || defultImage" height="180" cover />

                            <div
                                style="position:absolute; inset:0; background: linear-gradient(to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5));" />

                            <v-chip small class="ma-3 rounded-lg text-caption font-weight-medium"
                                style="position:absolute; top:0; left:0;">
                                {{ item.category?.title || 'General' }}
                            </v-chip>

                        </div>

                        <div class="pa-4">
                            <h4 class="text-h5 font-weight-bold py-3">
                                {{ item.title }}
                            </h4>

                            <p class=" text-light_text_on " v-html="truncateText(item.description, 30)">
                            </p>

                            <div v-if="isLongText(item.description)" class="">
                                <v-btn text color="primary" class="text-capitalize pa-0" variant="text"
                                    @click="$router.push(`/blog/${item.slug}`)" style="text-decoration: underline;">
                                    Read more
                                </v-btn>
                            </div>

                        </div>
                    </div>
                </v-col>
            </v-row>
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
        window.addEventListener("scroll", this.handleScroll);
    },

    beforeUnmount() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    watch: {
        selectedCategoryId(newVal) {
            this.loadDashboard(newVal);
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
        // truncateText(text, wordlimit = 30) {
        //     if (!text) return '';
        //     const words = text.split(' ');
        //     if (words.length > wordlimit) {
        //         return words.slice(0, wordlimit).join(' ') + '...';
        //     }
        //     return text;
        // },
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
                const finalCategoryId = categoryId ?? this.selectedCategoryId;

                const params = {
                    category_id: finalCategoryId
                };

                let res = await General.get("/api/web/getBlogDashboard", params);

                this.categories = [{ id: null, title: 'All' }, ...res.categories];

                if (this.selectedCategoryId === null) {
                    this.selectedCategoryId = null;
                }

                if (!finalCategoryId) {
                    this.featuredArticle = res.featured;
                    this.remainingArticles = res.remaining;
                    this.allArticles = [res.featured, ...res.remaining];
                } else {
                    this.featuredArticle = null;
                    this.remainingArticles = res.remaining;
                    this.allArticles = [...res.remaining];
                }

                this.allArticles = this.featuredArticle
                    ? [res.featured, ...res.remaining]
                    : [...res.remaining];

                this.currentIndex = 0;


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
</style>