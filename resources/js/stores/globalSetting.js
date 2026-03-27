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

    const settingsMap = {};

    res.data.forEach(item => {
      settingsMap[item.key] = item.value;
    });

    this.settings = settingsMap;

    console.log("FINAL SETTINGS:", this.settings);

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