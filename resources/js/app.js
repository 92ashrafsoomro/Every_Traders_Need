import { createApp } from 'vue';
import router from './route';
import pinia from './stores'
import App from './app.vue';
import { useUserStore } from './stores/user';

import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import './style.css';

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'


const vuetify = createVuetify({
  components,
    directives,
    theme: {
    defaultTheme: 'theme1', 
    themes: {
      theme1: {
        dark: true,
        colors: {
          background: '#FFFFFF',
          surface: '#FFFFFF',
          primary: '#1976D2',
          secondary: '#424242',
          success: '#4CAF50',
          warning: '#FB8C00',
          error: '#FF5252',
          info: '#2196F3',
        },
      },
      theme2: {
        dark: true,
        colors: {
          background: '#121212',
          surface: '#1E1E1E',
          primary: '#90CAF9',
          secondary: '#B0BEC5',
          success: '#81C784',
          warning: '#FFB74D',
          error: '#E57373',
          info: '#64B5F6',
        },
      },
    },
  },
})

const render = createApp(App);
render.use(pinia)
render.use(router);
render.use(vuetify)
const userStore = useUserStore();

(async () => {

        if(userStore.token){
            try {
                await userStore.syncUser();
            } catch (e) {
                console.warn('Auth sync failed:', e.message);
                // userStore.clearAuth();
            }
        }
    
        render.mount('#userApp');
    
})();

// render.mount('#userApp');