<template>
	<div>
        <!--custom breadcrumb end-->
        <section class="section-padding register_bg">
           <div class="container-fluid">
             <div class="row justify-content-center">
               <div class="col-lg-4 col-md-6 col-sm-8 col-12">
                    <div class="login-content">
                        <h2 class="login-title">Login </h2>
                        <form @submit.prevent="login">
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" name="phoneNumber" v-model="loginForm.phoneNumber" class="form-control">
                                <div v-if="loginForm.errors.has('phoneNumber')" v-html="loginForm.errors.get('phoneNumber')" />
                            </div>
                            <!-- form group -->
                            <div class="form-group mb-3">
                              <label for="password">Password</label>
                                <input v-model="loginForm.password" type="password" name="password" class="form-control" >
                                <div v-if="loginForm.errors.has('password')" v-html="loginForm.errors.get('password')" />
                            </div>
                            <input class="login-sub mb-3" type="submit" value="Login">
                            <router-link :to="{name:'forgetpassword'}" style="margin-left:10px; text-decoration: underline;">Forget Password</router-link>
                        </form>
                        <div class="scustomer-register">
                           <router-link :to="{name:'register'}">create new account</router-link>
                        </div>
                        <!-- <div class="px-4 text-body text-center">
                            <p>Or, Sign Up with</p>
                        </div>
                        <div class="socialLogin">
                          <ul>
                            <li><a href="" class="btn btn-facebook"><i class="fa fa-facebook"></i>Facebook</a></li>
                            <li class="gmail"><a href="" class="btn btn-gmail"><i class="fa fa-google"></i>Gmail</a></li>
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
import Form from 'vform'
import sidebar from '../includes/sidebar'
export default {
	components: {
    	sidebar,
    },
  data: () => ({
    loginForm: new Form({
      email: '',
      password: ''
    }),
  }),
  methods: {
    async login () {
      const response = await this.loginForm.post('/api/v1/customer/login').then(response=>{
        if(response.data.status=='success'){
            let token = response.data.token;
            localStorage.setItem('token',token)
            token = localStorage.setItem('token',token);
            this.$toast.success({
                title:'Success!',
                message:'You are logged in successfully.'
            });
            this.$store.dispatch("isLoggedIn");
            this.$router.push({name:'customeraccount'});
        }else{
            this.$toast.error({
                title:'Opps!',
                message:'Your email or password wrong.'
            });
        }
      })
    }
  }
}
</script>