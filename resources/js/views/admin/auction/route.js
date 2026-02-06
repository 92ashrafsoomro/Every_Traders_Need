import index from './index.vue'
import create from './create.vue'
import edit from './edit.vue'
import sheet from './sheet.vue'
import Vehicle from './vehicle/index.vue'
import Show from './vehicle/show/index.vue'

export default [
    {
        path: "auction",
        children: [  
            { path: '', component: index },
            { path: 'create', component: create },
            { path: 'edit/:id', component: edit },
            { path: 'sheet/:id', component: sheet },
            { path: 'vehicle/:id', component: Vehicle },
            { path: 'vehicle/show/:id', component: Show },
        ],
    },
]
