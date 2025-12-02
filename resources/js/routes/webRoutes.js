import Layout from '@/views/web/layout/index.vue'

import HomeView from "@/views/web/index.vue"


export default [
    {
        path: "/",
        component: Layout,
        children: [

            { 
                path: '/', 
                component: HomeView
            },
        ],
    },
]
