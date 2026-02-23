import DashboardLayout from "@views/user/layout/index.vue"
import AuctionFinder from "@views/user/auction-finder/index.vue"
import Auctionscheduler from "@views/user/auctionscheduler.vue"
import Compare from "@views/user/compare.vue"
import Dashboard from "@views/user/dashboard/index.vue"
import Interest from "@views/user/interest/index.vue"
import Reauction from "@views/user/reauction.vue"
import Watchlist from "@views/user/watchlist/index.vue"
import Profile from "@/views/user/profile/index.vue"
import VehicleDetail from "@/views/user/vehicle-detail/index.vue"
import Setting from "@views/user/setting/index.vue"
import navbar from "@/views/web/layout/navbar.vue" 
import Alert from "@/views/user/alert/index.vue"
import News from "@views/user/news/index.vue"
import NewsbyId from "@views/user/news/newsbyid.vue"
export default [
  {
        path: "/user",
        component: DashboardLayout,
        children: [
      { path: 'dashboard', component: Dashboard, meta: { requiresAuth: true, title: 'Dashboard' } },
      { path: 'auction-finder', component: AuctionFinder , meta: { requiresAuth: true, title: 'Auction Finder'  }},
      { path: "auctionscheduler", component: Auctionscheduler, meta: { requiresAuth: true, title: 'Auction Scheduler' }},
      { path: "reauction", component: Reauction, meta: { requiresAuth: true, title: 'Reauction Tracker'    }},
      { path: "alert", component: Alert, meta: { requiresAuth: true, title: 'Your Reminder' }},
      { path: "watchlist", component: Watchlist, meta: { requiresAuth: true, title: 'Watchlist'  }},
      { path: "interest", component: Interest , meta: { requiresAuth: true, title: 'Interest' } },
      { path: "compare", component: Compare, meta: { requiresAuth: true, title: 'Compare' } },
      { path: "profile", component: Profile, meta: { requiresAuth: true, title: 'Profile' } },
      { path: "vehicle-detail/:id", component: VehicleDetail, meta: { requiresAuth: true, title: 'Vehicle Detail' } },
      { path: "settings/:id", component: Setting, meta: { requiresAuth: true, title: 'Settings' } },
      { path: "news", component: News, meta: { requiresAuth: true, title: 'News' } },
      { path: "singlenews/:id?", component: NewsbyId, meta: { requiresAuth: true, title: 'News' } },
      { path: "web", component: navbar, meta: { requiresAuth: true, title: 'Web' } },
    ],
  },
]