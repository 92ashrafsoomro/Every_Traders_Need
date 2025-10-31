import { createApp } from 'vue';
import router from './route';
import pinia from './stores'
import App from './app.vue';
import { useUserStore } from './stores/user';

import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import './style.css';


const render = createApp(App);
render.use(pinia)
render.use(router);
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