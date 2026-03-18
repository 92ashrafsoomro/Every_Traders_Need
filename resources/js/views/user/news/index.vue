<template>
  <user-title-bar title="Auction & Market Updates"
    subtitle="Stay informed with the latest auction insights, market trends, and important platform updates."></user-title-bar>

  <v-container fluid class=" bg-background " style="padding: 0 !important;">
    <v-row no-gutters class="pa-2">
      <div class="d-flex d-md-none justify-space-between w-100 px-4 mb-3"
        style="background-color: rgb(var(--v-theme-primary),0.3);">
        <div>
          <h5>News</h5>
        </div>
        <div>
          <v-btn color="primary" variant="outlined" prepend-icon="mdi-filter" @click="drawer = true">
            Filter
          </v-btn>
        </div>
      </div>
      <v-col cols="12" md="3" class="d-none d-md-flex pa-0"
        style="position: sticky; top: 70px; height: calc(100vh - 70px);">
        <div class="w-100">

          <!-- CATEGORY -->
          <div class="d-flex align-center pa-4" style="background-color: rgb(var(--v-theme-primary),0.15);">
            <h4 class="mr-3">Select Category</h4>
            <Blogcategory label="Category" type="news" :model-value="filter.category_id"
              @update:modelValue="handleBlogFilter" density="compact" variant="outlined" clearable />
          </div>

          <!-- BLOG LIST -->
          <v-list lines="three" class="pa-0">
            <v-list-item v-for="item in filteredBlogs" :key="item.id"
              :class="{ 'selected-blog': selectedBlog?.id === item.id }" @click="selectBlog(item)">
              <v-list-item-title class="font-weight-bold text-wrap mb-1">
                {{ item.title }}
              </v-list-item-title>

              <div class="d-flex justify-space-between mt-2">
                <v-chip size="x-small" color="primary">
                  {{ item.category?.title || 'General' }}
                </v-chip>
                <span class="text-caption">{{ item.date }}</span>
              </div>
            </v-list-item>
          </v-list>
        </div>
      </v-col>

      <!-- MOBILE DRAWER -->
      <v-navigation-drawer v-model="drawer" temporary location="left" width="300" class="d-md-none">
        <div class="pa-4">
          <h4 class="mb-3">Select Category</h4>
          <Blogcategory label="Category" type="news" :model-value="filter.category_id"
            @update:modelValue="handleBlogFilter" density="compact" variant="outlined" clearable />
        </div>

        <v-list lines="three" class="pa-0">
          <v-list-item v-for="item in filteredBlogs" :key="item.id"
            :class="{ 'selected-blog': selectedBlog?.id === item.id }" @click="selectBlog(item); drawer = false">
            <v-list-item-title class="font-weight-bold text-wrap mb-1">
              {{ item.title }}
            </v-list-item-title>

            <div class="d-flex justify-space-between mt-2">
              <v-chip size="x-small" color="primary">
                {{ item.category?.title || 'General' }}
              </v-chip>
              <span class="text-caption">{{ item.date }}</span>
            </div>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-col cols="12" md="9" class="pa-2" style="border-left: 2px solid  rgb(var(--v-theme-border));">
        <v-card v-if="selectedBlog" flat rounded="lg" class="" style="padding: 0 !important;">
          <div class=" pa-6">
            <div class=" rounded-lg overflow-hidden " style="height: 200px; width: 100%;">
              <v-img :src="selectedBlog.image_preview || placeholder" height="200" cover class="rounded-lg"></v-img>
            </div>

            <div class="d-flex align-center justify-space-between mb-4">
              <div>
                <v-chip size="small" color="primary" class="mr-3">
                  {{ selectedBlog.category?.title || 'General' }}
                </v-chip>

              </div>
              <div class="d-flex align-center mt-4">
                <span class="text-caption mr-3">Share:</span>

                <v-btn icon="mdi-facebook" size="small" color="primary" variant="text" class="mr-2" />

                <v-btn icon="mdi-twitter" size="small" color="primary" variant="text" class="mr-2" />

                <v-btn icon="mdi-whatsapp" size="small" color="success" variant="text" />
              </div>
            </div>



            <div cols="12" md="7">
              <h1 class="text-h4 font-weight-bold mb-6">
                {{ selectedBlog.title }}
              </h1>
              <p class="text-light_text_on text-body-1">{{ selectedBlog.subtitle || "No Sub Title" }}</p>
              <div class="text-body-2 mt-2">
                {{ selectedBlog.date }}
              </div>
            </div>
          </div>
          <div>
            <v-divider />
            <div class="pa-6" v-html="selectedBlog.description">

            </div>
          </div>
          <!-- <div cols="12" md="5">
         
          </div> -->



          <!-- DESCRIPTION -->
          <!-- <div v-html="selectedBlog.description"></div> -->
        </v-card>

        <v-card v-else class="pa-6">
          Select a blog
        </v-card>
      </v-col>

    </v-row>
  </v-container>

</template>

<script>
import General from '@/models/general.model';
import image from '@/assets/images/screen/lightBg.png'
import Blogcategory from '@/components/Blogcategory.vue';

export default {
  components: {
    Blogcategory
  },
  data() {
    return {
      filter: {
        category_id: null,
      },
      blogs: [],
      drawer: false,
      image,
      showBlogs: true,
      selectedBlog: null,
      placeholder: 'https://placehold.co/600x400/000E20/FFFFFF?text=Blog+Image'
    };
  },

  mounted() {
    this.fetchBlogs();
  },

  methods: {
    handleBlogFilter(value) {
      this.filter.category_id = value;

      const list = this.filteredBlogs;
      this.selectedBlog = list.length ? list[0] : null;
    },
    async fetchBlogs() {
      try {
        const res = await General.get('/api/cruds/news', this.filter);
        this.blogs = res.data;

        if (this.blogs.length) {
          this.selectBlog(this.blogs[0]);
        }
      } catch (e) {
        console.error('Blogs error', e);
      }
    },

    toggleBlogList() {
      this.showBlogs = !this.showBlogs;
    },
    selectBlog(blog) {
      this.selectedBlog = blog;
    }
  },
  computed: {
    filteredBlogs() {
      if (!this.filter.category_id) {
        return this.blogs;
      }

      return this.blogs.filter(
        blog => blog.category?.id === this.filter.category_id
      )
    }
  }

};
</script>


<style scoped>
.text-wrap {
  white-space: normal;
}

.selected-blog {
  border-top: 2px solid rgb(var(--v-theme-border));
  border-bottom: 2px solid rgb(var(--v-theme-border));
  background-color: rgb(var(--v-theme-background));

}
</style>
