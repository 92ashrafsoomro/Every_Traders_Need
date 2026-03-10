import index from './index.vue'

export default [
    {
        path: "settings",
        children: [  
            { path: '', component: index },
        ],
    },
]
