<template>
  <user-title-bar title="Auction & Market Updates"
    subtitle="Stay informed with the latest auction insights, market trends, and important platform updates."></user-title-bar>

  <v-container fluid class=" bg-background" style="padding: 0 !important;">
    <v-row no-gutters>
      <v-col cols="12" md="3" class="pa-0" style="position: sticky; top: 70px; align-self: flex-start;">
        <div class="d-flex justify-space-between align-center pa-4"
          style="background-color: rgb(var(--v-theme-primary),0.2);">
          <div>
            <h4>Select Category</h4>
          </div>
          <div style="flex: 1; margin-left: 16px;">
        <Blogcategory 
  label="Category"
  type="news"
  variant="outlined"
  item-title="title"
  item-value="id"
  density="compact"
  hide-details 
  :model-value="filter.blogFilter"
  @update:modelValue="handleInput"
  class="id-box" 
  clearable 
/>



          </div>
        </div>

        <!-- Show/Hide the list -->
       <v-list lines="three" class="bg-background" style="padding: 0 !important;">
  <v-list-item v-for="item in blogs" :key="item.id"
    :class="{ 'selected-blog': selectedBlog && selectedBlog.id === item.id }"
    @click="selectBlog(item)">
    
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

      <v-col cols="12" md="9" class="px-12" style="border-left: 2px solid  rgb(var(--v-theme-border));">
        <v-card v-if="selectedBlog" flat rounded="lg" class="">
          <div class="bg-background pa-6">
            <div class="bg-background rounded-lg overflow-hidden " style="height: 200px;">
              <img :src="selectedBlog?.category?.image_preview || image" alt="Image" class="w-full h-full object-cover">
            </div>

            <div class="d-flex align-center justify-space-between mb-4">
              <div>
                <v-chip size="small" color="primary" class="mr-3">
                  {{ selectedBlog.category?.title || 'General' }}
                </v-chip>

              </div>
              <div class="d-flex align-center mt-4">
                <span class="text-caption mr-3">Share:</span>

                <v-btn icon="mdi-facebook" size="small" color="primary" variant="text" class="mr-2"
                  @click="shareFacebook" />

                <v-btn icon="mdi-twitter" size="small" color="primary" variant="text" class="mr-2"
                  @click="shareTwitter" />

                <v-btn icon="mdi-whatsapp" size="small" color="success" variant="text" @click="shareWhatsapp" />
              </div>
            </div>



            <div cols="12" md="7">
              <h1 class="text-h4 font-weight-bold mb-6">
                <!-- {{ selectedBlog.title }} -->
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt quo in, aspernatur
              </h1>
              <p class="text-light_text_on text-body-1">by Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
              <div class="text-body-2 mt-2">
                {{ selectedBlog.date }}
              </div>
            </div>
          </div>
          <div>
            <v-divider />
            <div class="pa-6">
              <!--<p> {{ selectedBlog.description }}</p> -->
              <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt quo in, aspernatur laborum
                obcaecati cupiditate minima maiores autem odio quasi atque at dolores suscipit ipsum minus corrupti
                fuga dicta reprehenderit!
                Recusandae modi aliquam, excepturi nam quam inventore neque asperiores! Ipsam culpa ipsa alias
                adipisci? Eius velit dolores sapiente maiores id, quis veritatis ullam totam. Earum, dicta. Sapiente
                iste sed magni.
                Vitae adipisci laborum nostrum iusto quia quod doloremque veniam, ea recusandae et nisi magnam qui est
                sapiente hic atque optio minus, sed culpa. Magnam ullam sint quam nostrum ab tempora.
                Id cumque doloribus, sit repellat incidunt repellendus ipsum quibusdam inventore tempore perferendis,
                animi, deleniti quis praesentium veritatis vero eum blanditiis iure sunt omnis! Quibusdam explicabo
                voluptatibus quas, dolorem molestiae illo?
                Quae eligendi accusantium laboriosam, doloribus quas, doloremque fugiat neque dicta, nihil in vero
                dignissimos laborum veritatis ipsa ipsam similique tenetur explicabo error impedit iusto nulla sed
                provident porro repellendus! Laborum!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt
                quo in, aspernatur laborum
                obcaecati cupiditate minima maiores autem odio quasi atque at dolores suscipit ipsum minus corrupti
                fuga dicta reprehenderit!
                Recusandae modi aliquam, excepturi nam quam inventore neque asperiores! Ipsam culpa ipsa alias
                adipisci? Eius velit dolores sapiente maiores id, quis veritatis ullam totam. Earum, dicta. Sapiente
                iste sed magni.
                Vitae adipisci laborum nostrum iusto quia quod doloremque veniam, ea recusandae et nisi magnam qui est
                sapiente hic atque optio minus, sed culpa. Magnam ullam sint quam nostrum ab tempora.
                Id cumque doloribus, sit repellat incidunt repellendus ipsum quibusdam inventore tempore perferendis,
                animi, deleniti quis praesentium veritatis vero eum blanditiis iure sunt omnis! Quibusdam explicabo
                voluptatibus quas, dolorem molestiae illo?
                Quae eligendi accusantium laboriosam, doloribus quas, doloremque fugiat neque dicta, nihil in vero
                dignissimos laborum veritatis ipsa ipsam similique tenetur explicabo error impedit iusto nulla sed
                provident porro repellendus! Laborum!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt
                quo in, aspernatur laborum
                obcaecati cupiditate minima maiores autem odio quasi atque at dolores suscipit ipsum minus corrupti
                fuga dicta reprehenderit!
                Recusandae modi aliquam, excepturi nam quam inventore neque asperiores! Ipsam culpa ipsa alias
                adipisci? Eius velit dolores sapiente maiores id, quis veritatis ullam totam. Earum, dicta. Sapiente
                iste sed magni.
                Vitae adipisci laborum nostrum iusto quia quod doloremque veniam, ea recusandae et nisi magnam qui est
                sapiente hic atque optio minus, sed culpa. Magnam ullam sint quam nostrum ab tempora.
                Id cumque doloribus, sit repellat incidunt repellendus ipsum quibusdam inventore tempore perferendis,
                animi, deleniti quis praesentium veritatis vero eum blanditiis iure sunt omnis! Quibusdam explicabo
                voluptatibus quas, dolorem molestiae illo?
                Quae eligendi accusantium laboriosam, doloribus quas, doloremque fugiat neque dicta, nihil in vero
                dignissimos laborum veritatis ipsa ipsam similique tenetur explicabo error impedit iusto nulla sed
                provident porro repellendus! Laborum!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt
                quo in, aspernatur laborum
                obcaecati cupiditate minima maiores autem odio quasi atque at dolores suscipit ipsum minus corrupti
                fuga dicta reprehenderit!
                Recusandae modi aliquam, excepturi nam quam inventore neque asperiores! Ipsam culpa ipsa alias
                adipisci? Eius velit dolores sapiente maiores id, quis veritatis ullam totam. Earum, dicta. Sapiente
                iste sed magni.
                Vitae adipisci laborum nostrum iusto quia quod doloremque veniam, ea recusandae et nisi magnam qui est
                sapiente hic atque optio minus, sed culpa. Magnam ullam sint quam nostrum ab tempora.
                Id cumque doloribus, sit repellat incidunt repellendus ipsum quibusdam inventore tempore perferendis,
                animi, deleniti quis praesentium veritatis vero eum blanditiis iure sunt omnis! Quibusdam explicabo
                voluptatibus quas, dolorem molestiae illo?
                Quae eligendi accusantium laboriosam, doloribus quas, doloremque fugiat neque dicta, nihil in vero
                dignissimos laborum veritatis ipsa ipsam similique tenetur explicabo error impedit iusto nulla sed
                provident porro repellendus! Laborum!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt
                quo in, aspernatur laborum
                obcaecati cupiditate minima maiores autem odio quasi atque at dolores suscipit ipsum minus corrupti
                fuga dicta reprehenderit!
                Recusandae modi aliquam, excepturi nam quam inventore neque asperiores! Ipsam culpa ipsa alias
                adipisci? Eius velit dolores sapiente maiores id, quis veritatis ullam totam. Earum, dicta. Sapiente
                iste sed magni.
                Vitae adipisci laborum nostrum iusto quia quod doloremque veniam, ea recusandae et nisi magnam qui est
                sapiente hic atque optio minus, sed culpa. Magnam ullam sint quam nostrum ab tempora.
                Id cumque doloribus, sit repellat incidunt repellendus ipsum quibusdam inventore tempore perferendis,
                animi, deleniti quis praesentium veritatis vero eum blanditiis iure sunt omnis! Quibusdam explicabo
                voluptatibus quas, dolorem molestiae illo?
                Quae eligendi accusantium laboriosam, doloribus quas, doloremque fugiat neque dicta, nihil in vero
                dignissimos laborum veritatis ipsa ipsam similique tenetur explicabo error impedit iusto nulla sed
                provident porro repellendus! Laborum!</p>
            </div>
          </div>
          <div cols="12" md="5">
            <v-img :src="selectedBlog.image_preview || placeholder" cover rounded="lg" />
          </div>



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
      filter:{
        blogFilter : null,
        length: 10,
        page: 1,
        offset: 0,
      },
      blogs: [],
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
     handleInput(value) {
   this.filter.blogFilter = value;  
    this.fetchBlogs();           
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

.selected-blog {
  border-top: 2px solid rgb(var(--v-theme-border));
  border-bottom: 2px solid rgb(var(--v-theme-border));
  background-color: rgb(var(--v-theme-background));
  /* border-radius: 0.5rem; */
}
</style>
