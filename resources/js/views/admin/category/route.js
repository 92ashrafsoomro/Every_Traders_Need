import Index from "./index.vue"
import Create from "./create.vue"
import Edit from './edit.vue'
export default [
    {
        path:"category",
        children:[
            { path: '' , component: Index},
            { path: 'create', component : Create},
            { path: 'edit/:id', component : Edit }
        ],
    },
]