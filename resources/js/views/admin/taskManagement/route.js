
import upComing from './upComing.vue'
import update from './update.vue'
import final from './final.vue'
import timeAuction from './timeAuction.vue'
import create from './create.vue'
import edit from './edit.vue'

export default [
    {
        path: "taskManagement",
        children: [
             { path: '', component: upComing },
            { path: 'upComing', component: upComing },
            { path: 'update', component: update },
            { path: 'final', component: final },
            // { path: 'timeAuction', component: timeAuction },
            { path: 'create', component: create },
            { path: 'edit/:id', component: edit, props: true },

        ],
    },
]
