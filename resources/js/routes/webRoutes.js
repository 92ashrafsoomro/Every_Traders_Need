import Layout from '@/views/web/layout/index.vue'
import HomeView from "@/views/web/home/index.vue"
import Home from '@/views/web/home.vue'
import About from '@/views/web/about/index.vue'
import Pricing from '@/views/web/pricing/index.vue'
import Support from '@/views/web/support/index.vue'
import Checkout from '@/views/web/checkout/index.vue'
import auctionsolutions from "@/views/web/auctionsolutions/index.vue"

export default [
    {
        path: "/",
        component: Layout,
        children: [

            { 
                path: '/', 
                component: HomeView
            },
            {
                path : 'home',
                component : Home ,
            },
            {
                path : "about",
                component: About,
            },
            {
                path : "pricing",
                component : Pricing
            },
            {
                path : "support",
                component : Support
            },
            {
                path : "checkout",
                component: Checkout,
                meta:{requiresAuth:true}
            },
            {
                path : "auctionsolutions",
                component : auctionsolutions
            },
            
            
            // {
            //     path : "feature",
            //     component : Features
            // }
        ],
    },
]
