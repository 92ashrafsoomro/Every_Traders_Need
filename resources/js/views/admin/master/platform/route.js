import index from './index.vue'
import edit from './edit.vue'
import create from './create.vue'


export default [
    {
        path: "platform",
        children: [
            { path: "", component: index },
            { path: "create", component: create },
            { path: "edit/:id", component: edit }
        ]
    }
]