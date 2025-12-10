import DashboardLayout from '@/views/admin/layout/index.vue';
import Register from '@views/auth/register.vue';
import Dashboard from "@/views/admin/dashboard/index.vue"



export default [
    {
        path: "/admin",
        component : DashboardLayout,
        children: [  
            { path: '', component: Dashboard },
            { path: 'dashboard', component: Dashboard },
            { path: 'register', component: Register},
        ],
    },
]
