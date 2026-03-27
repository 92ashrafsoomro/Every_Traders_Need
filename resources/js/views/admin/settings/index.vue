<template>
  <user-title-bar title="Global Settings" />
  <v-container fluid class="pa-4" max-width="1400px">
    <v-row no-gutters>
      <v-col cols="12" md="3" class="bg-surface">
        <v-tabs v-model="tab" direction="vertical" color="primary">
          <v-tab value="profile"><v-icon start>mdi-account</v-icon>Site Information</v-tab>
          <v-tab value="website"><v-icon start>mdi-earth</v-icon>Website Settings</v-tab>
        </v-tabs>
      </v-col>

      <v-col cols="12" md="9" class="pa-8 bg-surface">
        <v-window v-model="tab">
          <v-window-item value="profile">
            <site-information :form="form" />
          </v-window-item>

          <v-window-item value="website">
            <website-settings
              :form="form"
              :darkLogoUrl="darkLogoUrl"
              :lightLogoUrl="lightLogoUrl"
            />
          </v-window-item>

          <v-row class="mt-6">
            <v-col cols="12" class="text-right">
              <v-btn color="primary" @click="saveSettings">Save Settings</v-btn>
            </v-col>
          </v-row>
        </v-window>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import General from '@/models/general.model';
import SiteInformation from './SiteInformation.vue';
import WebsiteSettings from './WebsiteSettings.vue';
export default {
  components: {
      SiteInformation, 
      WebsiteSettings
    },
  data: () => ({
    tab: 'profile',
    darkLogoUrl: null,
    lightLogoUrl: null,
    form: {
      email: '',
      sitename: '',
      meta_title: '',
      meta_description: '',
      facebook: '',
      instagram: '',
      whatsapp: '',
      linkedin: '',
      youtube: '',
      weburl: '',
      phone: '',
      footertext: '',
    },
  }),
  mounted() {
    this.loadData()
  },
  methods: {
    uploadImage(type) {
      this.$refs[type + 'Input'].$el.querySelector('input').click();
    },

    handleFileChange(type, file) {
      if (!file) return;
      this.form[type + 'Logo'] = file;

      if (this[type + 'LogoUrl']) {
        URL.revokeObjectURL(this[type + 'LogoUrl']);
      }

      this[type + 'LogoUrl'] = URL.createObjectURL(file);
    },
    async loadData() {
        this.loading = true;
        try {
            let res = await General.get("/api/cruds/settings", this.filter)
            const data = res.data.data ?? res.data;
            this.form = {};
            data.forEach(item => {
                this.form[item.key] = item.value;
                if(item.key === 'darkLogo') this.darkLogoUrl = item.value;
                if(item.key === 'lightLogo') this.lightLogoUrl = item.value;
            });

            console.log("logo testing ",data);

            this.loading = false;
        } catch (error) {
            alert("Data Not Fetch ");
            this.loading = false;
        }
    },
    async saveSettings() {
    try {
        const res = await General.post("/api/cruds/settings", this.form)
        this.$alertStore.add(res.message || 'Settings Saved Successfully', 'success');

    } catch (error) {
        this.$alertStore.add(error.message || 'Settings Save Failed', 'error');
    }
}
    },
};
</script>

<style scoped>

</style>