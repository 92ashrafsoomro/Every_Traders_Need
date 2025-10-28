import { createApp } from 'vue';
import router from './route';
import App from './app.vue';
import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import './style.css';


const render = createApp(App);
render.use(router);
render.mount('#userApp');