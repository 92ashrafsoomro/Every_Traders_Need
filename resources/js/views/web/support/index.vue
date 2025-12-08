<template>
  <div class="mainContainer pa-0 bg-background" >
    <div class="content mt-16 mx-auto" style="max-width: 1900px;">
        <v-row class="h-100" align="center" justify="center">
      <v-col cols="12" lg="10" xl="9">
        <v-row no-gutters>
          <!-- Left: Title + Form -->
          <v-col cols="12" lg="6" class="pa-8 pa-md-12 mt-lg-10">
            <h1 class="text-h3 text-md-h2 text-white font-weight-bold mb-10 text-center text-lg-start">
              Autoboli<br/>Supported Page
            </h1>

            <div class="max-w-md mx-auto mx-lg-0">
              <v-text-field
                label="Name"
                v-model="form.name"
                placeholder="John Doe"
                variant="outlined"
                 bg-color="inputBg"
                base-color="gray-lighten-1"
                color="white"
                class="mb-6"
             
              ></v-text-field>

              <v-text-field
                label="Email"
                v-model="form.email"
                placeholder="john@example.com"
                variant="outlined"
                bg-color="inputBg"
                base-color="grey-lighten-1"
                color="white"
                class="mb-6"
       
              ></v-text-field>

              <v-textarea
                label="Message *"
                v-model="form.message"
                placeholder="I have a question about my subscription..."
                variant="outlined"
                 bg-color="inputBg"
                base-color="grey-lighten-1"
                color="white"
                rows="5"
                class="mb-8"
              
              ></v-textarea>

              <div class="d-flex flex-column  flex-sm-row mb-8" style="max-width: 200px;">
                <v-btn
                  color="primary"
                  size="x-large"
                  rounded="lg"
                  class="flex-grow-1 mr-lg-10"
                  @click="formSubmit"
                  
                >
                  Submit
                </v-btn>
              </div>

              <p class="text-shadow text-body-2">
                Hey! If you have a code-related question, please instead use
                <a href="#" class="text-primary text-decoration-none">the forum</a>.
              </p>
            </div>
          </v-col>

          <!-- Right: Quick Links -->
          <v-col cols="12" lg="6" class="pa-8 pa-md-12 mt-16 d-flex align-center justify-center">
            <div class="w-100" style="max-width: 560px;">
              <div
                v-for="n in 5"
                :key="n"
                class="mb-4 px-6  py-5 bg-surface border-thin rounded-lg d-flex align-center justify-space-between"
              >
                <span class="text-white   text-body-1">
                  {{ quickLinks[n - 1] }}
                </span>
                <v-icon color="grey-lighten-2" size="28">mdi-plus</v-icon>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    </div>
</div>
</template>

<script>
export default {
  name: 'StaticContactPage',

  data: () => ({
    quickLinks: [
      "I'm interested in a lifetime account.",
      "May I pay with PayPal?",
      "I have a question about business/team accounts.",
      "I have a code-related question.",
      "We're interested in advertising with you."
    ],
    form:{
        name : "",
        email:"",
        message : ""
    }
  }),
  methods:{
    async formSubmit(){
        try {
            let formResponse = ({
                name : this.form.name,
                email : this.form.email,
                message : this.form.message
            })
            console.log(formResponse);
            
        } catch (error) {
            console.log("Somthing Went Wrong" , error)
        }
    }
  }
}
</script>