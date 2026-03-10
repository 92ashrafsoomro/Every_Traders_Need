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
import auction from "@/views/admin/auction/route"
import vehicle from "@/views/admin/vehicle/route"
import members from "@views/admin/members/route" 
import transaction from "@views/admin/transaction/route" 
import dictionary from "@views/admin/dictionary/route"
import packages from "@views/admin/packages/route"
import plans from "@views/admin/plans/route"
import marketing from "@views/admin/marketing/route"
import access from "@views/admin/accessControl/route"
import adminList from "@views/admin/adminList/route"
import role from "@views/admin/role/route"
import permission from "@views/admin/permission/route"
import taskManagement from "@views/admin/taskManagement/route"
import staffUser from "@/views/admin/stafUser/route"
import newsBlog from "@/views/admin/newsBlog/route"
import blog from "@/views/admin/blog/route"
import category from "@/views/admin/category/route"
import restrictions from "@/views/admin/restrictions/route"
import supportTicket from "@/views/admin/supportTicket/route"
import globalSettings from "@/views/admin/settings/route"
export default [
    {
        path: "/admin",
        component : DashboardLayout,
        children: [  
            { path: '', component: Dashboard , },
            { path: 'dashboard', component: Dashboard },
            ...bodytypes,
            ...platform,
            ...vehicleType,
            ...color,
            ...make,
            ...variant,
            ...model,
            ...center,
            ...auction,
            ...vehicle,
            ...members,
            ...transaction,
            ...dictionary,
            ...packages,
            ...plans,
            ...marketing,
            ...access,
            ...adminList,
            ...role,
            ...permission,
            ...taskManagement,
            ...staffUser,
            ...newsBlog,
            ...blog,
            ...category,
            ...restrictions,
            ...supportTicket,
            ...globalSettings
            // ...upComing,
            // ...upGrade,
            // ...final,
            // ...timeAuction
            ]
    },
]