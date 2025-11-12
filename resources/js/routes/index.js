
import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from '@stores/userStore';
import { useAlertStore } from '@stores/alertStore';


import NotFound from "@views/user/404.vue"


import userRoutes from "./userRoutes"
import authRoutes from "./authRoutes"
import webRoutes from './webRoutes';



const routes = [
    ...webRoutes,
    ...authRoutes,
    ...userRoutes,
    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
        component: NotFound
    },
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