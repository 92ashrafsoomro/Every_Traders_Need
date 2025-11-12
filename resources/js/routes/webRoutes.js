import HomeView from "@/views/web/index.vue"



export default [
    {
        path: "/",
        children: [
            { path: '/', component: HomeView},
        ],
    },
]
