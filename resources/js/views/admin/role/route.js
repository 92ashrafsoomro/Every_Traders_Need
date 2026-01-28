import index from './index.vue'
// import show from './show/index.vue'
import create from "./create.vue"
import edit from './edit.vue'

export default [
    {
        path: "Role",
        children: [  
            { path: '', component: index },
            { path: 'create', component: create },
            { path: 'edit/:id', component: edit },
        ],
    },
]
