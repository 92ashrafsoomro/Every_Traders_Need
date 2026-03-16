import Layout from '@/views/web/layout/index.vue'
import HomeView from "@/views/web/home/index.vue"
import Home from '@/views/web/home.vue'
import About from '@/views/web/about/index.vue'
import Pricing from '@/views/web/pricing/index.vue'
import Support from '@/views/web/support/index.vue'
import Checkout from '@/views/web/checkout/index.vue'
import auctionsolutions from "@/views/web/auctionsolutions/index.vue"
import auctionschedule from "@views/web/auctionschedule/index.vue"
import privacy from '@/views/web/privacy/index.vue'
import cookie from '@views/web/privacy/Cookie.vue'
import terms from '@/views/web/privacy/Terms.vue'
import disclaimer from '@/views/web/privacy/Disclaimer.vue'
import faq from '@/views/web/privacy/Faq.vue'
import blog from '@/views/web/blog/index.vue'
import blogDetail from '@/views/web/blog-detail/index.vue'


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
                path: 'home',
                component: Home,
            },
            {
                path: "about",
                component: About,
            },
            {
                path: "pricing",
                component: Pricing,
            },
            {
                path: "support",
                component: Support
            },
            {
                path: "checkout",
                component: Checkout,
                meta: { requiresAuth: true }
            },
            {
                path: "auctionsolution",
                component: auctionsolutions
            },
            {
                path: "auctionschedule",
                component: auctionschedule
            },
            {
                path: "privacy",
                component: privacy
            },
            {
                path: "cookie",
                component: cookie
            },
            {
                path: "terms",
                component: terms
            },
            {
                path: "disclaimer",
                component: disclaimer
            },
            {
                path: "faqs",
                component: faq
            },
            {
                path: "blog",
                component: blog,
                meta: { breadcrumb: "Blogs" }
            },
            {
                path: "blog/:slug",
                component: blogDetail,
                meta: {

                    breadcrumb: [
                        { text: 'Blogs', to: '/blog' },
                        (route) => {
                            const slug = route.params.slug || '';
                            return slug

                        }]
                }
            }
        ],
    },
]
