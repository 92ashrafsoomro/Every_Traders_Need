<template>
  <v-container fluid style="min-height: 800px;" class="py-16 bg-background d-flex flex-wrap align-center">
    <div style="max-width: 1300px;" class="mx-auto">
      <!-- Page Heading -->
      <div class="text-center mb-10">
        <h2 class="text-h4 text-md-h3 font-weight-bold">
         Frequently asked questions
        </h2>

      </div>

      <!-- FAQ List -->
      <v-expansion-panels style="max-width: 800px; margin: auto; " class="my-transparent-panels">
        <v-expansion-panel v-for="(faq, index) in faqs" :key="index" elevation="0" variant="flat" class="faq-panel bg-background pa-2">
          <v-expansion-panel-title ripple="false" class="v-theme--dark bg-transparent">
            <div class="d-flex align-center justify-space-between w-100  " >
              <span class="text-body-1 font-weight-medium">
                {{ faq.question }}
              </span>
            </div>
          </v-expansion-panel-title>

          <v-expansion-panel-text>

            <p class="text-body-1 text-whiteLight " style="line-height: 2;">
              {{ faq.answer }}
            </p>
          </v-expansion-panel-text>

        </v-expansion-panel>
      </v-expansion-panels>

    </div>
  </v-container>
</template>

<script>
export default {
  name: "FaqPage",
  data() {
    return {
      faqs: [
        {
          question: "What is Autoboli?",
          answer:
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. "
        },
        {
          question: "How does Autoboli help auction buyers?",
          answer:
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco."
        },
        {
          question: "Is Autoboli suitable for dealers?",
          answer:
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate velit."
        },
        {
          question: "Can I track multiple auctions at once?",
          answer:
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Excepteur sint occaecat cupidatat non proident."
        },
        {
          question: "How do I get started with Autoboli?",
          answer:
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sunt in culpa qui officia deserunt mollit anim id est laborum."
        }
      ]
    }
  }
}
</script>

<style scoped>


</style>