import index from './index.vue'
import show from './show/index.vue'
import create from './create.vue'
import showTransaction from './showTransaction.vue'
export default [
    {
        path: "transaction",
        children: [  
            { path: '', component: index },
            { path: 'create' , component : create},
            { path: 'showTransaction/:id', component: showTransaction },
            { path: 'show/:id', component: show },
        ],
    },
]
