<template>
	  <div>
	  	<section class="mainbreadcrumb" style="background-image: url(./public/frontEnd/images/breadcrumb.png)">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-text">
                            <h3>Customer Profile</h3>
                        <ul>
                            <li class="active"><router-link :to="{name:'customeraccount'}">Home</router-link></li>
                            <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                            <li><a class="anchor">Change Password</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumt -->
        <section class="customer-profile ">
            <div class="container-fluid">
                <div class="row">
                    <div class="paddleft-120 col-lg-12 col-md-12 col-sm-12">
                        <div class="customer-profile">
                            <div class="row">
                                <div class="col-lg-3 col-sm-3 col-md-3">
                                    <div class="cprofile-sidebar">
                                        <Sidebar></Sidebar>
                                    </div>
                                </div>
                                <!-- col end -->
				               <div class="col-lg-9 col-md-9 col-sm-9">
				                    <div class="login-content">
				                        <h2 class="login-title">Change Password </h2>
				                        <form @submit.prevent="passwordchange">
				                            <div class="form-group">
				                                <label for="old_password">Old Password</label>
				                                <input type="password" name="old_password" v-model="changePassword.old_password" class="form-control">
				                               
				                            </div>
				                            <!-- form group -->
				                            <div class="form-group">
				                                <label for="newPassword">New Password</label>
				                                <input type="password" name="new_password" v-model="changePassword.new_password" class="form-control">
				                               
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
                    </div>
                </div>
            </div>
        </section>


	  </div>
</template>

<script>
import Form from 'vform'
import Sidebar from './Sidebar'
	export default{
        components:{
            Sidebar
        },
		data: () => ({
	    changePassword: new Form({
	     old_password: '',
	     new_password: '',
	    }),
	    }),
		methods:{
			 async passwordchange () {
		      const response = await this.changePassword.post('/api/v1/customer/password/change',{

		       headers:{
		      		Authorization: 'Bearer '+localStorage.getItem('token')
		      	}

		       }).then(response=>{
		       if(response.data.status=='success'){
		            this.$toast.success({
		                title:'Success!',
		                message:'Password change successfully.'
		            });
		            this.$router.push({name:'customeraccount'});
		        }else{
		            this.$toast.error({
		                title:'Opps!',
		                message:'Your Old Password does not match.'
		            });
		        }
		      })
		    },
		},

		mounted(){
            
        }
	}
    

</script>