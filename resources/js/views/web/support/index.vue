<template>
  <div class="mainContainer   ">
    <div class="content " style="min-height: 100vh; ">
      <v-row align="center" justify="center">

        <!-- Left: Title + Form -->
        <v-col cols="12" lg="6" class="bg-surface pa-md-12  position-relative " style="min-height: 100vh;">

          <!-- Background Image -->
          <!-- Background Image -->
          <v-card class="position-absolute top-0 left-0 elevation-24" :style="{
            width: '100%',
            height: '100%',
            backgroundImage: `url(${bgImage})`,
            backgroundSize: 'cover',
            backgroundPosition: 'center',
            opacity: 0.1,
            zIndex: 1
          }">

          </v-card>


          <div class="logo" style="position: absolute;">
            <img style="" height="40px" :src="logo" alt="">
          </div>
          <!-- Form Content -->
          <div style=" display: flex; justify-content: center; align-items: center; height: 90vh;">

            <div class="position-relative align-center justify-center " style="z-index: 2;  width: 500px;">
              <h1 class="text-h6 text-lg-h4  text-md-h5 text-white font-weight-bold mb-10 text-center text-lg-start">
                Help & Support
              </h1>

              <div class="max-w-md mx-auto mx-lg-0">
                <v-text-field label="Name" v-model="form.name" placeholder="John Doe" variant="outlined"
                  bg-color="background" base-color="border" color="white" class="mb-2"></v-text-field>

                <v-text-field label="Email" v-model="form.email" placeholder="john@example.com" variant="outlined"
                  bg-color="background" base-color="border" color="white" class="mb-2"></v-text-field>

                <v-textarea label="Description *" v-model="form.description"
                  placeholder="I have a question about my subscription..." variant="outlined" bg-color="background"
                  base-color="border" color="white" rows="5" class="mb-2"></v-textarea>

                <div class="d-flex  flex-sm-row mb-3" style="max-width: 200px;">

                  <v-btn color="primary" class="flex-grow-1 text-body-1  text-capitalize " style="height: 50px;"
                    @click="formSubmit">
                    Submit
                  </v-btn>
                  <!-- <v-btn color="white" class="flex-grow-1  ml-4 text-body-1   text-surface  text-capitalize" to="/">
                  Go Back
                </v-btn> -->
                </div>

              </div>
            </div>
          </div>

        </v-col>

        <!-- Right: Quick Links -->
        <v-col cols="12" lg="6" class=" pa-8 pa-md-12 d-flex align-center justify-center bg-background"
          style="min-height: 100vh;">
          <div class="w-100 " style="max-width: 560px;">
            <div v-for="(item, index) in quickLinks" :key="index" class="mb-4 px-6 py-1 border-thin rounded-sm"
              :class="activeIndex === index ? 'active-item' : 'bg-background'">

              <div class="d-flex align-center justify-space-between">
                <span class="text-white text-body-1">{{ item.heading }}</span>

                <v-btn icon variant="text">
                  <v-icon color="white"  size="20" @click="toggle(index)">
                    {{ activeIndex === index ? 'mdi-minus' : 'mdi-plus' }}
                  </v-icon>
                </v-btn>

              </div>

              <v-expand-transition>
                <div v-if="activeIndex === index" class="mt-3 text-light pb-4">
                  {{ item.description }}
                </div>
              </v-expand-transition>
            </div>
          </div>
        </v-col>

      </v-row>
    </div>
  </div>
</template>


<script>
import UserModel from '@/models/user.model';
import bgImage from "@/assets/images/reauction/Reauction.png"
import quickLinks from "@/json/support.json"
import logo from '@/assets/images/logo/logo.png'

export default {
  name: 'support',

  data: () => ({
    logo,
    bgImage,
    quickLinks,
    activeIndex: null,
    form: {
      name: "",
      email: "",
      description: ""
    }
  }),
  methods: {
    async formSubmit() {
      try {

        let formResponse = ({
          name: this.form.name,
          email: this.form.email,
          description: this.form.description
        })
        let res = await UserModel.supportForm(formResponse);
        this.$alertStore.add('Form Submited Succesfully', 'success');
        this.form.name = "";
        this.form.email = "";
        this.form.description = "";


      } catch (error) {
        this.$alertStore.add(error, 'error');

      }
    },

    toggle(index) {
      this.activeIndex = this.activeIndex === index ? null : index;
    }

  }
}
</script>

<style scoped>
/* .inner-shadow {
  box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
} */
.active-item {
  background-color: rgb(var(--v-theme-primary), 0.1);
  border: 1px solid rgb(var(--v-theme-broder));
}

.bg-background {
  background-color: rgb(var(--v-theme-background));
}
</style>