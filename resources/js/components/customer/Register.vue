<template>
    <div>
        <!-- <section class="section-padding register_bg" style="background-image: url('public/frontEnd/images/rangpur-city.jpg');"> -->
        <section class="section-padding register_bg" >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 col-sm-10">
                        <div class="login-content">
                            <h2 class="login-title">Create your Account</h2>
                            <form @submit.prevent="login">
                                <div class="form-group">
                                    <label for="fullName"><span>*</span> Full Name </label>
                                    <input type="text" name="fullName" v-model="registerForm.fullName" class="form-control" />
                                    <div v-if="registerForm.errors.has('fullName')" v-html="registerForm.errors.get('fullName')" />
                                </div>
                                <!-- form group -->
                                <div class="form-group">
                                    <label for="phoneNumber"><span>*</span> Phone Number</label>
                                    <input type="text" name="phoneNumber" v-model="registerForm.phoneNumber" class="form-control" />
                                    <div v-if="registerForm.errors.has('phoneNumber')" v-html="registerForm.errors.get('phoneNumber')" />
                                </div>
                                <!-- form group -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" v-model="registerForm.email" class="form-control" />
                                    <div v-if="registerForm.errors.has('email')" v-html="registerForm.errors.get('email')" />
                                </div>
                                <!-- form group -->
                                <div class="form-group">
                                    <label for="password"><span>*</span> Password </label>
                                    <input v-model="registerForm.password" type="password" name="password" class="form-control" />
                                    <div v-if="registerForm.errors.has('password')" v-html="registerForm.errors.get('password')" />
                                </div>
                                <div class="form-group">
                                    <label for="password"><span>*</span> Re-password </label>
                                    <input v-model="registerForm.confirmed" type="password" name="confirmed" class="form-control" />
                                    
                                </div>
                                <input class="login-sub" type="submit" value="SignUp" />
                            </form>
                            <div class="scustomer-register">
                                <p>have an account?</p>
                                <router-link :to="{name:'login'}">SignIn</router-link>
                            </div>

                           <!--  <div class="px-4 text-body text-center">
                                <p>Or, Sign Up with</p>
                            </div>
                            <div class="socialLogin">
                                <ul>
                                    <li>
                                        <a href="" class="btn btn-facebook"><i class="fab fa-facebook"></i>Facebook</a>
                                    </li>
                                    <li class="gmail">
                                        <a href="" class="btn btn-gmail"><i class="fab fa-google"></i>Gmail</a>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                        <!--login content end-->
                    </div>
                    <!-- col end -->
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import Form from "vform";
    import sidebar from "../includes/sidebar";
    export default {
        components: {
            sidebar,
        },
        data: () => ({
            registerForm: new Form({
                fullName: "",
                phoneNumber: "",
                email: "",
                password: "",
                confirmed: "",
            }),
        }),
        methods: {
            async login () {
              const response = await this.registerForm.post('/api/v1/customer/register').then(response=>{
                if(response.data.status=='success'){
                    let verifyphone = response.data.verifyphone;
                    let initpass = response.data.initpass;
                    localStorage.setItem('verifyphone',verifyphone);
                    localStorage.setItem('initpass',initpass);
                    this.$router.push({name:'accountverify'});
                }else{
                    this.$toast.error({
                        title:'Opps!',
                        message:'Your Credential Already Exit!.'
                    });
                }
              })
            },
        },
    };
</script>
