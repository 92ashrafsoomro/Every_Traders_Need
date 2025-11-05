
import { createRouter, createWebHistory } from 'vue-router';
// import { useUserStore } from './stores/user';



import Login from "./user/pages/auth/login.vue"
import NotFound from "./user/pages/404.vue"
import UserRoutes from "./user/route.js"


const routes = [
    ...UserRoutes,
    {
        path: "/login",
        component: Login,
    },
    { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
];

const router = createRouter({
    history: createWebHistory("/autoboli"),
    routes,
});



export default router;
