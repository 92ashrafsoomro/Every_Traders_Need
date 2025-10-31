import { createRouter, createWebHistory } from 'vue-router';
import Home from './pages/home.vue';
import Dashboard from './pages/dashboard.vue';
import About from './pages/about.vue';
import Contact from './pages/contact.vue';
import AuctionFinder from './pages/auction-finder.vue'
import NotFound from './pages/404.vue';
import DashboardLayout from './component/DashboardLayout.vue'
import Login from './pages/login.vue'
import { useUserStore } from './stores/user';

const routes = [
    {
        path: '/',
        component: DashboardLayout,
        children: [
            { path: '', component: Home },
            { path: 'dashboard', component: Dashboard ,meta: { auth: true }},
            { path: 'auction-finder', component: AuctionFinder },
            { path: 'home', component: Home },
            { path: 'about', component: About },
            { path: 'contact', component: Contact },
        ],
    },
    {
        path: '/login',
        component: Login,
    },
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound },
];

const router = createRouter({
    history: createWebHistory('/autoboli/userr'),
    routes,
});

router.beforeEach((to, from, next) => {

        const userStore = useUserStore();

        if (to.meta.auth) {
            
            if (!userStore.is_logged_in) {
                next({ path: '/login' });
            }

              next();
        } else {
            next();
        }

});

export default router;
