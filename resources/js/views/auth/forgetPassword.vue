<template>
    <div class=" w-100 h-100 bg-surface   pb-8" style="position: absolute;">
        <div class="pattern-bg"></div>
        <div class="position-relative  pt-5  " style=" max-width: 1400px; z-index: 10">

            <slot> </slot>
        </div>
    </div>
    <v-app class="bg-surface">
        <div class="position-absolute bottom-0 left-0 right-0 h-50 bg-primary"
            style="z-index: 0; border-radius:  0 300px 0 0;">
            <!-- clip-path: polygon(0 9%, 100% 0, 100% 100%, 0% 100%); -->
        </div>
        <AuthHeader></AuthHeader>
        <v-main style="z-index: 10;" class="h-screen d-flex align-center justify-center ">

            <v-card color="background" class="pa-10  mx-auto border-sm " rounded="lg" style="width: 500px;">
                <v-card-item>
                    <v-card-title class="text-center text-h5 text-md-h4 text-lg-h4 font-weight-bold text-capitalize">
                        Forget Password
                        <p class="text-body-2">Enter your email and we’ll send you a reset link.</p>
                    </v-card-title>
                </v-card-item>
                <v-divider>
                </v-divider>
                <div class="mt-4">
                    <v-row>

                        <v-col cols="12">
                            <v-text-field clearable v-model="form.email" type="email"
                                prepend-inner-icon="mdi-email-outline" variant="outlined" label="Email"
                                density="comfortable" color="primary" />
                        </v-col>
                        <v-col cols="12" class="">

                            <v-btn @click="formSubmit" color="primary" variant="flat" block size="large"
                                class="text-capitalize rounded-sm">
                                Verify Email
                            </v-btn>
                            <div class="d-flex justify-center  mt-4 "><router-link to="login"
                                    class="text-body-2 text-primary">Go Back</router-link></div>
                        </v-col>
                    </v-row>

                </div>
            </v-card>
        </v-main>
    </v-app>
</template>

<script>
import api from "@/plugins/axios";
import AuthHeader from "./AuthHeader.vue";
import UserModel from "@/models/user.model";

export default {
    name: "Login",
    components: {
        AuthHeader
    },
    data: () => ({
        form: {
            email: ""
        }
    }),
    methods: {
        async formSubmit() {
  try {
    let res = await api.post("/api/auth/forgotPassword", {
      email: this.form.email
    });

    this.form.email = "";
    this.$alertStore.add("Password reset link sent successfully");
    // this.$router.replace("/verifyemail");

  } catch (error) {
    this.$alertStore.add(
      error.response?.data?.message || "Something went wrong",
      "error"
    );
  }
}
    },
    
}
</script>