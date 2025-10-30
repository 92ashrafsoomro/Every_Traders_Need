import { createRouter, createWebHistory } from "vue-router";
import Home from "./pages/home.vue";
import Dashboard from "./pages/dashboard.vue";
import About from "./pages/about.vue";
import Contact from "./pages/contact.vue";
import AuctionFinder from "./pages/auction-finder/index.vue";
import AuctionScheduler from "./pages/auctionscheduler.vue";
import Interest from "./pages/interest.vue";
import Reauction from "./pages/reauction.vue";
import Watchlist from "./pages/watchlist.vue";
import Compare from "./pages/compare.vue";
import NotFound from "./pages/404.vue";
import DashboardLayout from "./component/DashboardLayout.vue";
import Login from "./pages/login.vue";

const routes = [
    {
        path: "/",
        component: DashboardLayout,
        children: [
            { path: "", component: Home },
            { path: "dashboard", component: Dashboard },
            { path: "/auction-finder", component: AuctionFinder },
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
    history: createWebHistory("/autoboli/userr"),
    routes,
});

export default router;
