<template>
	<div>
        <!--custom breadcrumb end-->
        <section class="section-padding">
           <div class="container-fluid">
             <div class="row">
              <div class="col-sm-4"></div>
               <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="login-content">
                        <h2 class="login-title">Reset Password</h2>
                        <form @submit.prevent="forgetreset">
                            <div class="form-group">
                                <label for="token">Verify Token</label>
                                <input type="text" name="token" v-model="resetforgetForm.token" class="form-control">
                                <div v-if="resetforgetForm.errors.has('token')" v-html="resetforgetForm.errors.get('token')" />
                            </div>
                            <!-- form group -->
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" v-model="resetforgetForm.password" class="form-control">
                                <div v-if="resetforgetForm.errors.has('password')" v-html="resetforgetForm.errors.get('password')" />
                            </div>
                            <!-- form group -->
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" v-model="resetforgetForm.confirm_password" class="form-control">
                                <div v-if="resetforgetForm.errors.has('confirm_password')" v-html="resetforgetForm.errors.get('confirm_password')" />
                            </div>
                            <!-- form group -->
                            <input class="login-sub mb-4" type="submit" value="Submit">
                        </form>
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
    resetforgetForm: new Form({
      token: '',
      password: '',
      confirm_password: '',
    }),
  }),
  methods: {
    async forgetreset () {
      const response = await this.resetforgetForm.post('/api/v1/customer/forget-password/reset',{
        headers:{
            customerphone: localStorage.getItem('customerphone'),
        }
       }).then(response=>{
        if(response.data.status=='success'){
            this.$toast.success({
                title:'Success!',
                message:'Success change your password'
            });
            this.$router.push({name:'customeraccount'});
        }else{
            this.$toast.error({
                title:'Opps!',
                message:'Your token not match.'
            });
        }
      })
    }
  }
}
</script>