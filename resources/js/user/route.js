import DashboardLayout from "./component/Layout/index.vue"
import AuctionFinder from "./pages/auction-finder/auctionFinder.vue"
import Auctionscheduler from "./pages/auctionscheduler.vue"
import Compare from "./pages/compare.vue"
import Dashboard from "./pages/dashboard.vue"
import Home from "./pages/home.vue"
import Interest from "./pages/interest.vue"
import Reauction from "./pages/reauction.vue"
import Watchlist from "./pages/watchlist/watchlist.vue"


export default [
    {
        path: "/",
        component: DashboardLayout,
        children: [
            { path: '', component: Dashboard },
            { path: 'dashboard', component: Dashboard},
            { path: 'auction-finder', component: AuctionFinder },    
            { path: "auctionscheduler", component: Auctionscheduler },
            { path: "interest", component: Interest },
            { path: "reauction", component: Reauction },
            { path: "watchlist", component: Watchlist },
            { path: "compare", component: Compare },
        ],
    },
]
