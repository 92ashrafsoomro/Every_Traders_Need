import index from './index.vue'
import create from './create.vue'
import edit from './chat.vue'
export default [
    {
        path: "supportTicket",
        children: [  
            { path: '', component: index },
            { path: 'create', component: create },  
            { path: 'chat/:id', component: edit },
        ],
    },
]
