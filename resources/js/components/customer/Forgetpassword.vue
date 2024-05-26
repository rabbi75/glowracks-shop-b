<template>
	<div>
        <!--custom breadcrumb end-->
        <section class="section-padding">
           <div class="container-fluid">
             <div class="row justify-content-center">
               <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="login-content">
                        <h2 class="login-title">Forget Password </h2>
                        <form @submit.prevent="forget">
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" name="phoneNumber" v-model="forgetForm.phoneNumber" class="form-control">
                                <div v-if="forgetForm.errors.has('phoneNumber')" v-html="forgetForm.errors.get('phoneNumber')" />
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
    forgetForm: new Form({
      email: '',
    }),
  }),
  methods: {
    async forget () {
      const response = await this.forgetForm.post('/api/v1/customer/forget-password').then(response=>{
        if(response.data.status=='success'){
            let customerphone = response.data.customerphone;
            localStorage.setItem('customerphone',customerphone);
            this.$toast.success({
                title:'Success!',
                message:'Please check your phone number.'
            });
            this.$router.push({name:'forgetpassverify'});
        }else{
            this.$toast.error({
                title:'Opps!',
                message:'Your phone number has not found.'
            });
        }
      })
    }
  }
}
</script>