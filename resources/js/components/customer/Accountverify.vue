<template>
	<div>
       
        <!--custom breadcrumb end-->
        <section class="section-padding">
           <div class="container-fluid">
             <div class="row">
              <div class="col-sm-4"></div>
               <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="login-content">
                        <h2 class="login-title">OTP Verify </h2>
                        <form @submit.prevent="verify">
                            <div class="form-group">
                                <label for="verifyPin">Vefiry Token</label>
                                <input type="text" name="verifyPin" placeholder="Enter Here" v-model="verifyForm.verifyPin" class="form-control">
                                <div v-if="verifyForm.errors.has('verifyPin')" v-html="verifyForm.errors.get('verifyPin')" />
                            </div>
                            <!-- form group -->
                            <div class="form-group">
                                <input class="login-sub form-control" type="submit" value="Submit">
                            </div>
                        </form>
                        <div class="resend">
                            <form @submit.prevent="resendverify">
                            <div class="form-group">
                                <button type="submit" class="text-danger"><i class="fas fa-sync-alt"></i> Resend OTP</button>
                            </div>
                        </form>
                        </div>
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
    verifyForm: new Form({
      phone: '',
    }),
    token:''
  }),
  methods: {
    async verify () {
      const response = await this.verifyForm.post('/api/v1/customer/verified',{
        headers:{
            verifyphone: localStorage.getItem('verifyphone'),
            initpass: localStorage.getItem('initpass')
        }
       }).then(response=>{
       if(response.data.status=='success'){
            let token = response.data.token;
            localStorage.setItem('token',token)
            token = localStorage.setItem('token',token);
            localStorage.removeItem('initpass');
            this.$toast.success({
                title:'Success!',
                message:'You are logged in successfully.'
            });
            this.$store.dispatch("isLoggedIn");
            this.$router.push({name:'customeraccount'});
        }else{
            this.$toast.error({
                title:'Opps!',
                message:'Your token invalid.'
            });
        }
      })
    },
    async resendverify () {
      const response = await this.verifyForm.put('/api/v1/customer/resend/verify',{
        headers:{
            verifyphone: localStorage.getItem('verifyphone')
        }
       }).then(response=>{
       if(response.data.status=='success'){
            this.$toast.success({
                title:'Success!',
                message:'Send OTP in your phone.'
            });
        }else{
            this.$toast.error({
                title:'Opps!',
                message:'You have no valid account.'
            });
        }
      })
    }
  }
};
</script>