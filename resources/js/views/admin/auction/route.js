import index from './index.vue'
import create from './create.vue'
import edit from './edit.vue'
import Fix from './fix.vue'
import sheet from './sheet.vue'




export default [
    {
        path: "auction",
        children: [  
            { path: '', component: index },
            { path: 'fix', component: Fix },
            { path: 'create', component: create },
            { path: 'edit/:id', component: edit },
            { path: 'sheet/:id', component: sheet },
        ],
    },
]
