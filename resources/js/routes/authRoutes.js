import ForgetPassword from "@/views/auth/forgetPassword.vue";
import ResetPassword from "@/views/auth/resetPassword.vue";
import Login from "@views/auth/login.vue"
import Register from '@views/auth/register.vue';
// import Emailverify from '@views/auth/verifyEmail.vue';




export default [
    {
        path: "/",
        children: [
            { path: 'login', component: Login},
            { path: 'register', component: Register},
            {path:'forget', component:ForgetPassword},
            // {path : "emailverify" ,  component : Emailverify ,    props: true,},
            {path : "resetpassword", component : ResetPassword }
        ],
    },
]
