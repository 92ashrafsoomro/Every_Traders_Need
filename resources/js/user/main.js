import { createApp } from 'vue';
import router from './route';
import App from './app.vue';

const render = createApp(App);
render.use(router);
render.mount('#userApp');