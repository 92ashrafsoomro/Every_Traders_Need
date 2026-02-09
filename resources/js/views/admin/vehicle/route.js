import index from './index.vue'
import show from './show/index.vue'

export default [
    {
        path: "vehicle",
        children: [  
            { path: '', component: index },
            { path: 'show/:id', component: show },
        ],
    },
]
