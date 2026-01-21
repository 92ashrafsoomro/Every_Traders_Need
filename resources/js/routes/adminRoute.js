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
import plans from "@views/admin/plans/route"
import marketing from "@views/admin/marketing/route"
import access from "@views/admin/accessControl/route"
import adminList from "@views/admin/adminList/route"
import role from "@views/admin/role/route"
import permission from "@views/admin/permission/route"
import auctionSchedule from "@views/admin/auctionSchedule/route"
import taskManagement from "@views/admin/taskManagement/route"
// import upComing from '@views/admin/taskManagement/upcoming/route'
// import upGrade from '@views/admin/taskManagement/upGrade/route'
// import final from '@views/admin/taskManagement/final/route'
// import timeAuction from '@views/admin/taskManagement/timeAuction/route'

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
            ...auctionSchedule,
            ...vehicle,
            ...members,
            ...transaction,
            ...dictionary,
            ...plans,
            ...marketing,
            ...access,
            ...adminList,
            ...role,
            ...permission,
            ...taskManagement
            // ...upComing,
            // ...upGrade,
            // ...final,
            // ...timeAuction
            ]
    },
]