
import index from './index.vue'
import Edit from './edit.vue'
import Create from './create.vue'
export default [
    {
        path: "packages",
         children: [  
                    { path: '', component: index },
                    { path: 'create', component: Create },
                    { path: 'edit/:id', component: Edit },
        ],
    },
]
