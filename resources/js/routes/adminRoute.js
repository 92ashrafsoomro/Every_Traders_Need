import DashboardLayout from '@/views/admin/layout/index.vue';
// import Dashboard from "@/views/user/layout/index.vue";
import Register from '@views/auth/register.vue';
import dashboard from "@views/user/dashboard/index.vue"



export default [
    {
        path: "/admin",
        component : DashboardLayout,
        children: [  
            { path: 'dashboard', component: Register },
            { path: 'register', component: Register},
        ],
    },
]
