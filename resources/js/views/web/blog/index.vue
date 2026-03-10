<template>
    <div   style="margin-top: 100px;">
        <div class="mx-auto" style="max-width: 1400px;">
            <h1 class="text-h4 font-weight-bold mb-6">Blog & articles</h1>
            <div v-if="featuredArticle" class=" rounded-lg d-flex d-flex-wrap " >
                <div  class="">
                    <img :src="featuredArticle.image_preview" height="380" width="700" />

                </div>


                <div class="pl-10  d-flex flex-column" style="min-height: 380px;">

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
                    <div class="mt-auto pa-6">
                    <router-link :to="`/blog/${featuredArticle.slug}`" style="text-decoration: none;">
                        <div class="button-hover d-flex justify-space-between align-center pa-3"
                            style="min-width:100px; max-width:130px; border-radius:40px;">

                            <div class="text ml-2 mr-2">
                                Read more
                            </div>
                            
                
                        </div>
                    </router-link>
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

                <v-chip-group v-model="selectedCategory" mandatory class="mb-8">
                    <v-chip v-for="category in categories" :key="category" :value="category" color="primary"
                        variant="outlined" class="mr-3 text-capitalize">
                        {{ category.title }}
                    </v-chip>
                </v-chip-group>


                <v-row dense="">

                    <v-col v-for="(item, i) in remainingArticles" :key="i">
                        <div class="rounded-lg  h-100 ml-2  d-flex flex-column" hover
                            style="background-color: rgb(var(--v-theme-background));">
                            <div style="width: 400px; height: 180px; position: relative; overflow: hidden;">


                                <img :src="item.image_preview" style="width:100%; height:100%; object-fit:cover;" />


                                <div style="
                                        position:absolute;
                                        inset:0;
                                        background: linear-gradient(to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5));
                                    "></div>


                                <v-chip small color="primary" class="ma-3 text-caption font-weight-medium"
                                    style="position:absolute; top:0; left:0;">
                                    {{ item.category?.title || 'General' }}
                                </v-chip>

                            </div>
                            <p class="text-subtitle-1 font-weight-medium py-3">
                                {{ item.title }}
                            </p>

                            <p class="text-body-2 grey--text text--darken-1 flex-grow-1"
                                v-html="truncateText(item.description,20)"></p>

                            <v-card-actions v-if="isLongText(item.description)" class="pb-4 px-4">
                                <v-btn text color="primary" class="text-capitalize pa-0"
                                   @click="$router.push(`/blog/${item.slug}`)">
                                    Read more
                                </v-btn>
                            </v-card-actions>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </div>
    </div>
</template>

<script>
import General from '@/models/general.model';

export default {
  data() {
    return {
      selectedCategory: null,
      categories: [],
      featuredArticle: null,    
      remainingArticles: [],     
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

    truncateText(text,wordlimit=30) {
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


                window.scrollTo({ top: 0, behavior: 'smooth' });

            } catch (error) {
                console.error("Dashboard load failed:", error);
            } finally {
                this.loading = false;
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

</style>