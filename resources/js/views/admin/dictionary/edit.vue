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
              <v-col cols="4">
                <BaseField v-model="form.companyName" label="Company / Trading or Business Name" required />
              </v-col>
              <v-col cols="4">
                <BaseSelect v-model="form.businessType" label="Business Type" :items="businessTypes" required />
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.companyReg" label="Company Registration" required/>
              </v-col>
            </v-row>

            <v-row class="mb-6">
              <v-col cols="4">
                <BaseField v-model="form.website" label="Website" />
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.businessEmail" label="Business Email" />
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.motorTradeInsurance" label="Motor Trade Insurance" />
              </v-col>
            </v-row>

            <v-row class="mb-6">
              <v-col cols="4">
                <BaseField v-model="form.vatNumber" label="VAT Number" />
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.companyAddress1" label="Company Address 1" required/>
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.companyAddress2" label="Company Address 2" />
              </v-col>
            </v-row>

            <v-row class="mb-6">
              <v-col cols="4">
                <BaseField v-model="form.townCity" label="Town / townCity" required/>
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.country" label="Country" required/>
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.postcode" label="Postcode" required/>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="4">
                <BaseField v-model="form.telephone" label="Telephone" required/>
              </v-col>
            </v-row>
          </v-card-text>

          <div class="border-b"></div>
          <v-card-text>
            <h3 class="text-h4 font-weight-bold mb-4">Personal Information</h3>

            <v-row class="mb-6">
              <v-col cols="4">
                <BaseField v-model="form.firstName" label="First Name" required />
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.surname" label="Surname" required/>
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.title" label="Title" required/>
              </v-col>
            </v-row>

            <v-row class="mb-6">
              <v-col cols="4">
                <BaseField v-model="form.jobTitle" label="Job Title" required/>
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.phone" label="Phone" required/>
              </v-col>
              <v-col cols="4">
                <BaseField v-model="form.personalEmail" label="Personal Email" required/>
              </v-col>
            </v-row>

            <v-row class="mb-6">
              <v-col cols="4">
                <BaseField v-model="form.password" label="Password" required/>
              </v-col>
              <v-col cols="4">
                <BaseImageUpload v-model="form.upload_id" label="Upload ID" />
              </v-col>
              <v-col cols="4">
                <BaseImageUpload v-model="form.avatar" label="Avatar" />
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="4">
                <BaseSelect v-model="form.status" label="Status" :items="Status" required />
              </v-col>
            </v-row>
          </v-card-text>

          <div class="border-b"></div>
          <v-card-text>
            <h3 class="text-h4 font-weight-bold mb-4">Proof</h3>

            <v-row class="mb-6">
              <v-col cols="4">
                <BaseImageUpload v-model="form.proof_motor_trade" label="Proof of Motor Trade" />
              </v-col>
              <v-col cols="4">
                <BaseImageUpload v-model="form.proof_address" label="Upload Proof of Address" />
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12" class="text-center">
                <v-btn color="primary" @click="submitForm">
                  {{ isEdit ? 'Update User' : 'Create User' }}
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
import Members from '@/models/member.model';

export default {
  components: { BaseField, BaseSelect, BaseImageUpload },

  data() {
    return {
      form: {
        companyName: "",
        businessType: "",
        companyReg: "",
        website: "",
        businessEmail: "",
        motorTradeInsurance: "",
        vatNumber: "",
        companyAddress1: "",
        companyAddress2: "",
        townCity: "",
        country: "",
        postcode: "",
        telephone: "",

        firstName: "",
        surname: "",
        title: "",
        jobTitle: "",
        phone: "",
        personalEmail: "",
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
      ],
      isEdit: false,
      loading: false,
    };
  },

  async mounted() {
    if (this.$route.params.id) {
      this.isEdit = true;
      await this.fetchUser();
    }
  },

  methods: {
    async fetchUser() {
      this.loading = true;
      try {
        const res = await Members.show(this.$route.params.id);

        if (res.data) {
          const record = res.data;
          this.form.companyName = record.companyName || '';
          this.form.businessType = record.businessType || '';
          this.form.companyReg = record.companyReg || '';
          this.form.website = record.website || '';
          this.form.businessEmail = record.businessEmail || '';
          this.form.motorTradeInsurance = record.motorTradeInsurance || '';
          this.form.vatNumber = record.vatNumber || '';
          this.form.companyAddress1 = record.companyAddress1 || '';
          this.form.companyAddress2 = record.companyAddress2 || '';
          this.form.townCity = record.townCity || '';
          this.form.country = record.country || '';
          this.form.postcode = record.postcode || '';
          this.form.telephone = record.telephone || '';

          this.form.firstName = record.firstName || '';
          this.form.surname = record.surname || '';
          this.form.title = record.title || '';
          this.form.jobTitle = record.jobTitle || '';
          this.form.phone = record.phone || '';
          this.form.personalEmail = record.personalEmail || '';
          this.form.status = record.status || '';

          this.form.upload_id = record.uploadID || null;
          this.form.avatar = record.avatar || null;

          this.form.proof_motor_trade = record.motorTradeProof || null;
          this.form.proof_address = record.addressProof || null;
        }
      } catch (e) {
        this.$alertStore.add('Failed to load platform', 'error');
      } finally {
        this.loading = false;
      }
    },

    async submitForm() {
    try {
        let formData = new FormData();

        // Object ko FormData me convert
        for (const key in this.form) {
        if (this.form[key] !== null && this.form[key] !== undefined) {
            formData.append(key, this.form[key]);
        }
        }

        if (this.isEdit) {
        await Members.update(this.$route.params.id, formData);
        this.$alertStore.add('User updated successfully', 'success');
        } else {
        await Members.create(formData);
        this.$alertStore.add('User created successfully', 'success');
        }

        this.goBack();
    } catch (error) {
        console.error(error);
        this.$alertStore.add('Operation failed', 'error');
    }
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
