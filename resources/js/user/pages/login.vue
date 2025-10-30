<template>

    <div :class="'main'+' theme-mode-'+themeStore.themeMode">
        <LoginHeader />

    <div class="relative d-flex align-items-center justify-content-center">
        <div class="container mx-auto px-4">
            <div class="">
                <div class="card shadow">

                    <h1 class="text-center">Welcome back!</h1>     
                    <div class="google-icon">
                        <a href="https://localhost/autoboli/auth/google">
                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" />
                            <span>Continue with Google</span>
                        </a>
                    </div>

                    <div class="divider relative">
                        <span></span>
                        <p>OR</p>
                        <span></span>
                    </div>

                    <!-- Form -->
                    <form action="https://localhost/autoboli/login_submit" method="POST" class="">
                        <div class="form-group">
                            <label>Work Email</label>
                            <input v-model="form.email" type="email" class="form-control" placeholder="Enter your work email" />
                            <p v-if="errors.email" class="text-danger">{{ errors.email[0]}}</p>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" v-model="form.password" name="password" class="form-control" placeholder="Enter password" />
                            <p v-if="errors.password" class="text-danger">{{ errors.password[0]}}</p>
                        </div>

                        <div class="my-2 d-flex align-items-center justify-content-between text-sm">
                            <label class="inline align-items-center gap-2">
                                <input type="checkbox" id="rememberMe" class="rounded ">
                                <span class="text-white dark:text-gray-700">Remember me</span>
                            </label>
                            <a href="http://localhost/autoboli/forgot-password" class="">Forgot Password?</a>
                        </div>

                        <button :disabled="loading" type="button" @click="login()" class="w-100 btn btn-primary">{{ loading ? 'Loading..' : 'Log In' }}</button>
                    </form>

                    <!-- SSO -->
                    <p class="mt-3 text-center text-white text-sm">
                        Don’t have an account? <a href="#" class="font-semibold">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    </div>
</template>

<script>
    import { useThemeStore } from '../stores/theme'
    import LoginHeader from '../component/LoginHeader.vue'
    import api from '../plugins/axios';
     

   
   export default {
        name: 'Login',
        components: {
          LoginHeader, 
        },
        data() {
            return {
                themeStore: useThemeStore(),
                errors: {  
                },
                loading:false,
                form: {
                    email: '',
                    password:'',
                }
            }
        },
        computed: {
        
        },
        methods: {
            login() {

                this.loading = true;
                const form = new FormData();
                form.append("email", this.form.email);
                form.append("password", this.form.password);

                api.post('/api/auth/login', form)
                    .then((res) => {

                        if (res.data.token) {
                            localStorage.setItem("auth_token", res.data.token);
                            api.defaults.headers.common["Authorization"] = `Bearer ${res.data.token}`;
                            this.$router.push("/");
                        } else {
                            alert('Something Went Wrong');
                        }

                    }).catch((error) => {

                        this.loading = false;

                        if (error?.response?.data?.errors) {
                            this.errors = error.response.data.errors;
                        } else if (error?.response?.data?.message) {
                            alert(error.response.data.message);
                        }else{
                            alert('Something Went Wrong');
                        }
                        
                    });

            }
            
        },
    }

</script>

<style scoped>

    .theme-mode-dark{
        background-color: #000F21;
    }

    .theme-mode-light{
        background-color: #f3f4f6;
    }

    .card{
        padding: 18px 40px;
        padding-top: 30px;
        max-width:512px;
        margin: auto;
        border-radius: 0.25rem;
        background:#0f1c2c;
    }

    .card h1{
        font-size: 1.875rem;
        line-height: 2.25rem;
        color: white;
        margin-bottom: 10px;
    }

    .google-icon{
        width: 100%;
        text-align: center;
        border: 1px solid white;
        border-radius: 8px;
        padding: 10px;
    }

    .google-icon a{
        text-decoration: none;
    
    }

    .google-icon a span{
        text-decoration: none;
        color: white;
        font-weight: 500;
    }

    .google-icon img{
        width: 31px;
        padding-right: 11px;
    }

    .divider{
        color: white;
        display: flex;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .divider span{
        border-bottom: 1px solid #686d79;
        display: block;
        width: 100%;
        
    }

    .divider p{
        margin: 0px;
        font-size: 12px;
        padding: 0px 10px;
        font-weight: 700;
    }

 
    /* Form */
    label{
        color: white;
        padding-bottom: 10px;
        font-weight: 700;
        font-size: 12px;

    }

    form a{
        text-decoration: none;
    }

    .form-group{
      margin-bottom: 10px;     
    }

    input{
        background: #000F21;
    }

    input:focus {
        background: #000F21!important;
    }

    input::placeholder {
        color: #999; /* your desired color */
        opacity: 1;  /* ensure it's not transparent */
    }

    
</style>
