import index from './index.vue'
// import show from './show/index.vue'
import create from "./create.vue"

export default [
    {
        path: "members",
        children: [  
            { path: '', component: index },
            { path: 'create', component: create },
            // { path: 'show/:id', component: show },
        ],
    },
]
