<script setup>
//All libary import
import {useAuthStore} from '@/stores/auth';
import {ref,reactive, inject} from 'vue';
import { useRouter } from 'vue-router';


//All instance
const authStore = useAuthStore();
const router = useRouter();
const swal = inject('$swal');

//All variable
const loginForm = reactive({
    email:null,
    password:null
});


const schema = reactive({
    email:`required|email`,
    password:`required`
});

//Methods
const  login = ()=>{
    authStore.login(loginForm,(status)=>{
      
        if(status.success == 'success'){
            swal({
                icon:'success',
                timer:1000,
                title:authStore.message
            });
            router.push('/dashboard')
        }else{
            swal({
                icon:`error`,
                timer:1000,
                title:authStore.message
            })
             router.push({name:'login'})
        }
    });
}

//Hooks & Computed
</script>
<template>
    <div class="auth-bg-basic d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 py-5 px-3">
                <div class="row justify-content-center">
                    <div class="col-xl-5">
                        <div class="text-center text-muted mb-2">
                            <div class="pb-3">
                                <a href="index.html">
                                    <span class="logo-lg">
                                        <img src="@/assets/images/logo-sm.svg" alt="" height="24"> <span
                                            class="">Inventory</span>
                                    </span>
                                </a>
                                <p class="text-muted font-size-15 w-75 mx-auto mt-3 mb-0">User Experience &amp;
                                    Interface Design Strategy Saas Solution</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-transparent shadow-none border-0">
                            <div class="card-body">
                                <div class="py-3">
                                    <div class="text-center">
                                        <h5 class="mb-0">Welcome</h5>
                                        <p class="text-muted mt-2">Sign in to continue to Inventroy.</p>
                                    </div>
                                    <vee-form class="mt-4 pt-2" @click="login" :validation-schema="schema">
                                        <div class="form-floating form-floating-custom mb-3">
                                            <vee-field type="email" v-model="loginForm.email" name="email" class="form-control"
                                                placeholder="Enter Email" />
                                            <label for="input-username">Email</label>
                                            <div class="form-floating-icon">
                                                <i class="uil uil-users-alt"></i>
                                            </div>
                                            <ErrorMessage name="email" class="text-danger" />
                                        </div>

                                        <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                            <vee-field type="password" v-model="loginForm.password" class="form-control" id="password-input"
                                                placeholder="Enter Password" name="password" />
                                            <button type="button"
                                                class="btn btn-link position-absolute h-100 end-0 top-0"
                                                id="password-addon">
                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                            </button>
                                            <label for="password-input">Password</label>
                                            <div class="form-floating-icon">
                                                <i class="uil uil-padlock"></i>
                                            </div>
                                            <ErrorMessage name="password" class="text-danger" />
                                        </div>

                                        <div class="form-check form-check-primary font-size-16 py-1">
                                            <input class="form-check-input" type="checkbox" id="remember-check">
                                            <div class="float-end">
                                                <a href="auth-resetpassword-basic.html"
                                                    class="text-muted text-decoration-underline font-size-14">Forgot
                                                    your password?</a>
                                            </div>
                                            <label class="form-check-label font-size-14" for="remember-check">
                                                Remember me
                                            </label>
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100" type="button">Log In</button>
                                        </div>
                                      
                                    </vee-form><!-- end form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->

                <!-- <div class="row">
                    <div class="col-xl-12">
                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>document.write(new Date().getFullYear())</script>
                                2024 Vuesy. Crafted with <i
                                    class="mdi mdi-heart text-danger"></i> by Themesdesign
                            </p>
                        </div>
                    </div>
                </div> -->
                 <!-- end row -->
            </div>
        </div>
        <!-- end container fluid -->
    </div>
</template>