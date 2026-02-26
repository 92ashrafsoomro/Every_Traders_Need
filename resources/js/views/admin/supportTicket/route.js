import index from './index.vue'
import edit from './edit.vue'

export default [
    {
        path: "supportTicket",
        children: [  
            { path: '', component: index },
            { path: 'edit/:id', component: edit },
        ],
    },
]
