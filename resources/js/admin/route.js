import { createRouter, createWebHistory } from 'vue-router';
import Home from './pages/home.vue';
import NotFound from './pages/404.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/home', component: Home },
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound },
];

const router = createRouter({
    history: createWebHistory('/autoboli/adminn'),
    routes,
});

export default router;
