<template>
<v-container max-width="1400px">
  <v-col cols="12">
    <v-card class="border ">
      <div class="d-flex align-center justify-space-between px-4 py-3">
        <h3 class="text-h6 font-weight-bold">Create Members</h3>
        <v-btn variant="text" color="primary" @click="goBack">
          <v-icon start>mdi-arrow-left</v-icon>
          Back
        </v-btn>
      </div>
<div class="mx-6">


      <div class="border-b"></div>
      <v-card-text>
        <h3 class="text-h4 font-weight-bold mb-4">Company Details</h3>

        <v-row class="mb-6">
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.company_name" label="Company / Trading or Business Name" required />
          </v-col>:v-list-item
  v-else
  :to="item.path"
  link
  :ripple="false"
  class="text-subtitle-1 mt-2"
  :class="{
    'bg-primary on-primary rounded my-active-menu hide-overlay':
      $route.path === item.path || isChildActive(item)
  }"
  @click="item.children?.length ? openSubSidebar(item) : closeSubSidebar()"
>v-

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseSelect v-model="form.business_type" label="Business Type" :items="businessTypes" required />

          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.company_registration" label="Company Registration" required/>
          </v-col>
        </v-row>

        <v-row class="mb-6">
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.website" label="Website" />
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.business_email" label="Business Email" />
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.motor_trade_insurance" label="Motor Trade Insurance" />
          </v-col>
        </v-row>

        <v-row class="mb-6">
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.vat_number" label="VAT Number" />
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.address_1" label="Company Address 1" required/>
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.address_2" label="Company Address 2" />
          </v-col>
        </v-row>

        <v-row class="mb-6">
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.city" label="Town / City" required/>
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.country" label="Country" required/>
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.postcode" label="Postcode" required/>
          </v-col>
        </v-row>

        <v-row>
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.telephone" label="Telephone" required/>
          </v-col>
        </v-row>
      </v-card-text>

      <div class="border-b"></div>

      <v-card-text>
        <h3 class="text-h4 font-weight-bold mb-4">Personal Information</h3>

        <v-row class="mb-6">
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.first_name" label="First Name" required />
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.surname" label="Surname" required/>
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.title" label="Title" required/>
          </v-col>
        </v-row>

        <v-row class="mb-6">
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.job_title" label="Job Title" required/>
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.phone" label="Phone" required/>
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.personal_email" label="Personal Email" required/>
          </v-col>
        </v-row>

        <v-row class="mb-6">
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseField v-model="form.password" label="Password" required/>
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseImageUpload v-model="form.upload_id" label="Upload ID" />
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
             <BaseImageUpload v-model="form.avatar" label="Avatar" />
          </v-col>
        </v-row>

        <v-row>
          <v-col  cols="12" lg="4" md="4" sm="12">
            <BaseSelect v-model="form.status" label="Status" :items="Status" required />
            
          </v-col>
        </v-row>
      </v-card-text>

      <div class="border-b"></div>
      <v-card-text>
        <h3 class="text-h4 font-weight-bold mb-4">Proof</h3>

        <v-row class="mb-6">
          <v-col  cols="12" lg="4" md="4" sm="12">
             <BaseImageUpload v-model="form.proof_motor_trade" label="Proof of Motor Trade" />
          </v-col>

          <v-col  cols="12" lg="4" md="4" sm="12">
            <!-- <BaseField v-model="form.proof_address" label="Proof of Address" required/> -->
             <BaseImageUpload v-model="form.proof_address" label="Upload Proof of Address" />
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" class="text-center">
            <v-btn color="primary" @click="submitForm">
              Create User
            </v-btn>
          </v-col>
        </v-row>
      </v-card-text>
</div>
    </v-card>
  </v-col>
</v-container>
</template>


<script>
import BaseField from "./component/BaseField.vue";
import BaseSelect from "./component/BaseSelect.vue";
import BaseImageUpload from "./component/BaseImageUpload.vue";
export default {
  components: { BaseField,BaseSelect,BaseImageUpload },

  data() {
    return {
      form: {
        company_name: "",
        business_type: "",
        company_registration: "",
        website: "",
        business_email: "",
        motor_trade_insurance: "",
        vat_number: "",
        address_1: "",
        address_2: "",
        city: "",
        country: "",
        postcode: "",
        telephone: "",

        first_name: "",
        surname: "",
        title: "",
        job_title: "",
        phone: "",
        personal_email: "",
        password: "",
        upload_id: null,
        avatar: null,
        status: "",

        proof_motor_trade: null,
        proof_address: null,
      },
      businessTypes: [
        { label: "Motor Trader", value: "Motor Trader" },
        { label: "Car Supermarket", value: "Car Supermarket" },
        { label: "Franchise Dealer", value: "Franchise Dealer" },
        { label: "Fleet", value: "Fleet" },
        { label: "Small Independent", value: "Small Independent" },
        { label: "Large Independent", value: "Large Independent" }
        ],
    Status: [
        { label: "Active", value: 1 },
        { label: "Deactivate", value: 0 },
    ]

    };
  },

  methods: {

    submitForm() {
      console.log(this.form);
    },
    goBack() {
      this.$router.back();
    }
  }
};
</script>



<style scoped>
.buttonBorder {
  border-radius: 2px;
}

.custom-input :deep(input) {
  text-transform: capitalize;
  font-weight: 500;
}


</style>
