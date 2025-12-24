import index from './index.vue'
import create from './create.vue'
import edit from './edit.vue'
// import csv from './Csv/index.vue'




export default [
    {
        path: "auction",
        children: [  
            { path: '', component: index },
            { path: 'create', component: create },
            { path: 'edit/:id', component: edit },
            // { path: 'csv/:id', component: csv },
        ],
    },
]
