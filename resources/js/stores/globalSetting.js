import { defineStore } from 'pinia'
import General from '@/models/general.model'

export const useGlobalSettingStore = defineStore('globalSetting', {

  state: () => ({
    settings: {},
    loading: false
  }),

actions: {
  async loadSettings() {
    try {
      this.loading = true;
      const res = await General.get('/api/web/globalsettings');

      // Agar data array hai: [{key: 'site_name', value: 'Autoboli'}, ...]
      // Toh isse object mein convert karein:
      const settingsMap = {};
      res.data.forEach(item => {
        settingsMap[item.key] = item.value;
      });

      this.settings = settingsMap; // Ab ye { site_name: 'Autoboli' } ban gaya

    } catch (error) {
      console.error('Global Settings Load Error', error);
    } finally {
      this.loading = false;
    }
  }
},

  getters: {

    getSetting: (state) => {
      return (key) => state.settings[key] ?? null
    }

  }

})