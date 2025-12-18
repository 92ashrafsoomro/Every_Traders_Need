import index from './index.vue'


export default [
    {
        path: "/csv",
        children: [  
            { path: '', component: index },
        ],
    },
]
