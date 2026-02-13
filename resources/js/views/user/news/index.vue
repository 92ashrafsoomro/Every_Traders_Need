<template>
  <user-title-bar title="Auction & Market Updates"
    subtitle="Stay informed with the latest auction insights, market trends, and important platform updates."></user-title-bar>
  <v-app>
    <v-main>
      <v-container fluid class="fill-height bg-background" style="padding: 0 !important;">
        <v-row no-gutters class="fill-height">
          <v-col cols="12" md="3" class="border-e">
            <div class="d-flex justify-space-between pa-4" style="background-color: rgb(var(--v-theme-primary));">
              <div>
                <h4>Blog</h4>
              </div>
              <div>
                <!-- Toggle the list on click -->
                <v-icon @click="toggleBlogList">mdi-arrow-down-thick</v-icon>
              </div>
            </div>

            <!-- Show/Hide the list -->
            <v-list v-if="showBlogs" lines="three" bg-color="transparent" class="pa-2">
              <v-list-item v-for="item in blogs" :key="item.id" :active="selectedBlog && selectedBlog.id === item.id"
                active-color="primary" class="border-b" @click="selectBlog(item)">
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

          </v-col>

          <v-col cols="12" md="9" class="pa-6 pa-md-12">
            <v-card v-if="selectedBlog" flat rounded="lg" class="pa-6">

              <div class="d-flex align-center mb-4">
                <v-chip size="small" color="primary" class="mr-3">
                  {{ selectedBlog.category?.title || 'General' }}
                </v-chip>
                <span class="text-body-2">
                  {{ selectedBlog.date }}
                </span>
              </div>


              <v-row>
                <v-col cols="12" md="7">
                  <h1 class="text-h4 font-weight-bold mb-6">
                    {{ selectedBlog.title }}
                  </h1>


                  <div class="d-flex align-center mt-4">
                    <span class="text-caption mr-3">Share:</span>

                    <v-btn icon="mdi-facebook" size="small" color="primary" variant="elevated" class="mr-2"
                      @click="shareFacebook" />

                    <v-btn icon="mdi-twitter" size="small" color="primary" variant="elevated" class="mr-2"
                      @click="shareTwitter" />

                    <v-btn icon="mdi-whatsapp" size="small" color="success" variant="elevated" @click="shareWhatsapp" />
                  </div>
                </v-col>

                <v-col cols="12" md="5">
                  <v-img :src="selectedBlog.image_preview || placeholder" cover rounded="lg" />
                </v-col>
              </v-row>

              <v-divider class="my-8" />

              <!-- DESCRIPTION -->
              <div v-html="selectedBlog.description"></div>
            </v-card>

            <v-card v-else class="pa-6">
              Select a blog
            </v-card>
          </v-col>

        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import General from '@/models/general.model';

export default {
  data() {
    return {
      blogs: [],
      showBlogs: true,
      selectedBlog: null,
      placeholder: 'https://placehold.co/600x400/000E20/FFFFFF?text=Blog+Image'
    };
  },

  mounted() {
    this.fetchBlogs();
  },

  methods: {
    async fetchBlogs() {
      try {
        const res = await General.get('/api/cruds/news');
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
    },
    shareFacebook() {
      const url = encodeURIComponent(window.location.href);
      window.open(
        `https://www.facebook.com/sharer/sharer.php?u=${url}`,
        '_blank'
      );
    },

    shareTwitter() {
      const url = encodeURIComponent(window.location.href);
      const text = encodeURIComponent(this.selectedBlog.title);
      window.open(
        `https://twitter.com/intent/tweet?url=${url}&text=${text}`,
        '_blank'
      );
    },

    shareWhatsapp() {
      const url = encodeURIComponent(window.location.href);
      window.open(
        `https://wa.me/?text=${url}`,
        '_blank'
      );
    }
  }

};
</script>


<style scoped>
.text-wrap {
  white-space: normal;
}
</style>
