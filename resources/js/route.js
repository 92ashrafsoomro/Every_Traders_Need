
import { createRouter, createWebHistory } from 'vue-router';
// import { useUserStore } from './stores/user';

import DashboardLayout from './user/component/Layout/index.vue'

import Home from './user/pages/home.vue';
import Dashboard from './user/pages/dashboard.vue';
import About from './user/pages/about.vue';
import Contact from './user/pages/contact.vue';
import AuctionFinder from './user/pages/auction-finder/index.vue'
import NotFound from './user/pages/404.vue';
import Login from './user/pages/login/login.vue'
import AuctionScheduler from "./user/pages/auctionscheduler.vue";
import Interest from "./user/pages/interest.vue";
import Reauction from "./user/pages/reauction.vue";
import Watchlist from "./user/pages/watchlist/index.vue";
import Compare from "./user/pages/compare.vue";



const routes = [
    {
        path: "/",
        component: DashboardLayout,
        children: [
            { path: '', component: Home },
            { path: 'dashboard', component: Dashboard ,meta: { auth: true }},
            { path: 'auction-finder', component: AuctionFinder },
            { path: 'home', component: Home },
            { path: 'about', component: About },
            { path: 'contact', component: Contact },
            { path: "auction-finder", component: AuctionFinder },
            { path: "auctionscheduler", component: AuctionScheduler },
            { path: "interest", component: Interest },
            { path: "reauction", component: Reauction },
            { path: "watchlist", component: Watchlist },
            { path: "compare", component: Compare },
            { path: "home", component: Home },
            { path: "about", component: About },
            { path: "contact", component: Contact },
        ],
    },
    {
        path: "/login",
        component: Login,
    },
    { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
];

const router = createRouter({
    history: createWebHistory("/autoboli/user"),
    routes,
});



export default router;
