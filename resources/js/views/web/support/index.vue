<template>
  <div class="mainContainer position-relative">

         <AuthHeader />

    <div class="content" style="min-height: 100vh;">
      <v-row no-gutters>

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
            opacity: 0.09,
            zIndex: 1
          }">

          </v-card>



          <!-- Form Content -->
          <div style=" display: flex; justify-content: center; align-items: center; height: 90vh;">

            <div class="position-relative align-center justify-center pa-4 pa-lg-0" style="z-index: 2;  width: 500px;">
              <h1
                class="text-h6 text-lg-h4  text-md-h5 text-whiteLite font-weight-bold mb-10 text-center text-lg-start">
                Help & Support
              </h1>

              <div class="max-w-md mx-auto mx-lg-0">
                <v-text-field label="Name" v-model="form.name" placeholder="John Doe" variant="outlined"
                  bg-color="background" base-color="border" color="white" class="mb-2"></v-text-field>

                <v-text-field label="Email" v-model="form.email" placeholder="john@example.com" variant="outlined"
                  bg-color="background" base-color="border" color="white" class="mb-2"></v-text-field>
                <v-text-field label="Subject" v-model="form.subject" placeholder="Subject of your message" variant="outlined"
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

        

       <v-col cols="12" lg="6"
        class="pa-8 pa-md-12 d-flex flex-column align-center justify-center"
        style="min-height:100vh;">

        <!-- FAQ Heading -->
        <div class="mb-6 text-start" style="width:100%; max-width:560px; ">
          <h2 class="text-h4 font-weight-bold mb-2">
            FAQ's
          </h2>
          <p class="text-body-2 text-medium-emphasis">
            Frequently Asked Questions
          </p>
          <div style="border-bottom: 1px solid rgb(var(--v-theme-border)); margin-top: 20px;"></div>
        </div>

        <!-- FAQ Panels -->
        <v-expansion-panels
          v-model="activeIndex"
          style="width:100%; max-width:560px;"
          elevation="0"
          variant="accordion"
          class="my-transparent-panels"
        >
          <v-expansion-panel
            v-for="(item,index) in quickLinks"
            :key="index"
            elevation="0"
            variant="flat"
            class="faq-panel bg-background pa-2 mb-3"
          >

            <v-expansion-panel-title
              class="v-theme--dark bg-transparent px-0"
              hide-actions
            >
              <div class="d-flex align-center justify-space-between w-100">
                <span class="text-whiteLite text-body-1">
                  {{ item.heading }}
                </span>

                <v-icon v-if="activeIndex === index">mdi-minus</v-icon>
                <v-icon v-else>mdi-plus</v-icon>
              </div>
            </v-expansion-panel-title>

            <v-expansion-panel-text>
              <div v-if="activeIndex === index" class="mt-3 text-whiteLite pb-4">
                {{ item.description }}
              </div>
            </v-expansion-panel-text>

          </v-expansion-panel>
        </v-expansion-panels>

      </v-col>


      </v-row>
    </div>
  </div>
</template>


<script>
import UserModel from '@/models/user.model';
import bgImage from "@/assets/images/support/supportImage.png"
import quickLinks from "@/json/support.json"
import logo from '@/assets/images/logo/logo.png'
import darkLogo from "@/assets/images/header/darkfull.png"
import lightLogo from "@/assets/images/header/lightfull.png"
import { useUserStore } from '@/stores/userStore';
import { useTheme } from "vuetify";
import AuthHeader from '@/views/auth/AuthHeader.vue';
import { useThemeStore } from '@/stores/themeStore';

export default {
  name: 'support',
 components: { AuthHeader },
  data() {
    return {
      themeStore: useThemeStore(),
      userStore: useUserStore(),
      vuetify: useTheme(),
      logo,
      AuthHeader,
      activeIndex: null,
      bgImage,
      quickLinks,
      form: {
        name: "",
        email: "",
        subject:"",
        description: ""
      }
    }
  },
  methods: {
    images() {
      return this.isDark ? [lightLogo] : [darkLogo]
    },
    toggleTheme() {
      this.vuetify.change(this.isDark ? "adminLight" : "adminDark")
    },
    async formSubmit() {
      try {

        let formResponse = ({
          name: this.form.name,
          email: this.form.email,
          subject: this.form.subject,
          description: this.form.description
        })
        let res = await UserModel.supportForm(formResponse);
        this.$alertStore.add('Form Submited Succesfully', 'success');
        this.form.name = "";
        this.form.email = "";
        this.form.subject = "";
        this.form.description = "";


      } catch (error) {
        this.$alertStore.add(error, 'error');

      }
    },

    toggle(index) {
      this.activeIndex = this.activeIndex === index ? null : index;
    }
  },
  computed: {
    isDark() {
      return this.vuetify.global.name === "adminDark"
    }, currentLogo() {
      if (this.isDark) {
        return darkLogo
      } else {
        return lightLogo
      }
    }
  },
  watch: {
    'theme.global.name'(newName) {
      this.vuetify.global.name = newName
    },
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

.v-expansion-panel--active {
  background-color: rgb(var(--v-theme-primary), 0.1) !important; 
}
/* 
.v-expansion-panel--active .v-expansion-panel-text {
  background-color: rgb(var(--v-theme-primary), 0.15) !important; 
} */


/* .v-expansion-panel-title:hover {
  background-color: rgb(var(--v-theme-primary), 0.1) !important;
} */

/* .v-expansion-panels.variant-accordion > .v-expansion-panel:not(:last-child)::after {
  border-color: rgb(var(--v-theme-primary)) !important;
} */
</style>