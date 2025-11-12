import { createPinia } from 'pinia'
import { useAlertStore } from './alertStore';
import { useThemeStore } from './themeStore';

const pinia = createPinia()



export function registerStores(app) {
  app.config.globalProperties.$alertStore = useAlertStore();
  app.config.globalProperties.$themeStore = useThemeStore();
}

export default pinia