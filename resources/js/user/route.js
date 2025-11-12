import DashboardLayout from "./component/Layout/index.vue"
import AuctionFinder from "./pages/auction-finder/index.vue"
import Auctionscheduler from "./pages/auctionscheduler.vue"
import Compare from "./pages/compare.vue"
import Dashboard from "./pages/dashboard.vue"
import Interest from "./pages/interest/index.vue"
import Reauction from "./pages/reauction.vue"
import Watchlist from "./pages/watchlist/index.vue"
import Profile from "./pages/profile.vue"
import Settings from "./pages/settings.vue"
import News from "./pages/news.vue"
import Support from "./pages/support.vue"
import VehicleDetail from "./pages/vehicle-detail/index.vue"
// import HomeView from "./pages/index.vue"


export default [
    {
        path: "/user",
        component: DashboardLayout,
        children: [
            // { path: '', component: Dashboard },
            { path: 'dashboard', component: Dashboard, meta: { requiresAuth: true } },
            { path: 'auction-finder', component: AuctionFinder },
            { path: 'dashboard', component: Dashboard },
            { path: "auctionscheduler", component: Auctionscheduler },
            { path: "interest", component: Interest },
            { path: "reauction", component: Reauction },
            { path: "watchlist", component: Watchlist },
            { path: "compare", component: Compare },
            { path: "profile", component: Profile },
            { path: "settings", component: Settings },
            { path: "news", component: News },
            { path: "support", component: Support },
            { path: "vehicle-detail", component: VehicleDetail },
        ],
    },
]
