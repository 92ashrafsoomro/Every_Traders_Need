import index from './index.vue'


export default [
    {
        path: "/vehicle",
        children: [  
            { path: '', component: index },
        ],
    },
]
