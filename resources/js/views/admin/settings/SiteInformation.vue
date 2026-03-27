<template>
  <v-row class="mt-4">
    <v-col cols="12" md="6">
      <v-text-field label="Contact Email" v-model="form.email" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="Site Name" v-model="form.sitename" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="Meta Title" v-model="form.meta_title" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="Meta Description" v-model="form.meta_description" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="Facebook URL" v-model="form.facebook" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="Instagram URL" v-model="form.instagram" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="Whatsapp" v-model="form.whatsapp" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="LinkedIn" v-model="form.linkedin" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="YouTube" v-model="form.youtube" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="Website URL" v-model="form.weburl" variant="outlined" density="compact" />
    </v-col>
    <v-col cols="12" md="6">
      <v-text-field label="Phone" v-model="form.phone" variant="outlined" density="compact" />
    </v-col>
  </v-row>
</template>

<script>
export default {
  props: {
    form: Object,
  },
};
</script>