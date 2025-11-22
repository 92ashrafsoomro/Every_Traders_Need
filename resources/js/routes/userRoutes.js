import DashboardLayout from "@views/user/layout/index.vue"

import AuctionFinder from "@views/user/auction-finder/index.vue"
import Auctionscheduler from "@views/user/auctionscheduler.vue"
import Compare from "@views/user/compare.vue"
import Dashboard from "@views/user/dashboard.vue"
import Interest from "@views/user/interest/index.vue"
import Reauction from "@views/user/reauction.vue"
import Watchlist from "@views/user/watchlist/index.vue"
import Profile from "@/views/user/profile/index.vue"
import Settings from "@views/user/settings.vue"
import News from "@views/user/news.vue"
import Support from "@views/user/support.vue"
import VehicleDetail from "@views/user/vehicle-detail/index.vue"

import Setting from "@views/user/setting/index.vue"



export default [
    {
        path: "/user",
        component: DashboardLayout,
        children: [
            { path: 'dashboard', component: Dashboard, meta: { requiresAuth: true } },
            { path: 'auction-finder', component: AuctionFinder , meta: { requiresAuth: true } },
            { path: 'dashboard', component: Dashboard },
            { path: "auctionscheduler", component: Auctionscheduler, meta: { requiresAuth: true }  },
            { path: "interest", component: Interest , meta: { requiresAuth: true } },
            { path: "reauction", component: Reauction, meta: { requiresAuth: true } },
            { path: "watchlist", component: Watchlist, meta: { requiresAuth: true } },
            { path: "compare", component: Compare, meta: { requiresAuth: true } },
            { path: "profile", component: Profile, meta: { requiresAuth: true } },
            { path: "settings", component: Settings, meta: { requiresAuth: true } },
            { path: "news", component: News, meta: { requiresAuth: true } },
            { path: "support", component: Support, meta: { requiresAuth: true } },
            { path: "vehicle-detail/:id", component: VehicleDetail, meta: { requiresAuth: true } },
            { path: "settings/:id", component: Setting, meta: { requiresAuth: true } },
        ],
    },
]
