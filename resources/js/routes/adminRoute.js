import DashboardLayout from '@/views/admin/layout/index.vue';
import Dashboard from "@/views/admin/dashboard/index.vue"
import platform from '@/views/admin/master/platform/route'
import bodytypes from '@/views/admin/master/bodyType/route'
import vehicleType from "@/views/admin/master/vehicalType/route"
import color from "@/views/admin/master/color/route"
import make from "@/views/admin/master/make/route"
import model from "@/views/admin/master/model/route"
import variant from "@/views/admin/master/variant/route"
import center from "@/views/admin/master/center/route"
import csv from "@/views/admin/csv/route"

export default [
    {
        path: "/admin",
        component : DashboardLayout,
        children: [  
            { path: '', component: Dashboard },
            { path: 'dashboard', component: Dashboard },
            ...bodytypes,
            ...platform,
            ...vehicleType,
            ...color,
            ...make,
            ...variant,
            ...model,
            ...center,
            ...csv
                ]
    },
]