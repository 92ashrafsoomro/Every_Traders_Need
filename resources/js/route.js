
import { createRouter, createWebHistory } from 'vue-router';
// import { useUserStore } from './stores/user';
import { useUserStore } from '@stores/userStore';
import { useAlertStore } from '@stores/alertStore';

import HomeView from "./web/pages/index.vue"
import Login from "./user/pages/auth/login.vue"
import NotFound from "./user/pages/404.vue"
import UserRoutes from "./user/route.js"


const routes = [
    {
        path: "/",
        component: HomeView,
    },
    {
        path: "/login",
        component: Login,
    },
    ...UserRoutes,
    { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
];

const router = createRouter({
    history: createWebHistory("/autoboli"),
    routes,
});



router.beforeEach(async (to, from, next) => {

    const auth = useUserStore()
    const alertStore = useAlertStore()

    //Auth Restriction
    if (to.meta.requiresAuth) {

        try {

            const res = await auth.getProfile();
            auth.user = res.account;
            auth.is_logged_in = true;
            //  alertStore.add('User Logged In','success')
            next();

        } catch (error) {

            auth.user = {};
            auth.is_logged_in = false;
            alertStore.add('Session Expired. Please Login Again.', 'warning')
            localStorage.removeItem('auth_token');
            next('/login');
        }

    } else {
        next()
    }


});

export default router;
