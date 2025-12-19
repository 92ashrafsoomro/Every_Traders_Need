import index from './index.vue'
import create from './create.vue'
import edit from './edit.vue'


export default [
    {
        path: "platform",
        children: [
            { path: "", component: index },
            { path: 'create', component: create },
            {path: 'edit/:id', component: edit, props: true},
        ]
    }
]