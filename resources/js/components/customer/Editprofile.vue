<template>
	  <div>
	  	<section class="mainbreadcrumb" style="background-image: url(./public/frontEnd/images/breadcrumb.png)">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-text">
                            <h3>Profile Edit</h3>
                        <ul>
                            <li class="active"><a href="">Home</a></li>
                            <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                            <li><a class="anchor">Profile Edit</a></li>
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
                                    <div class="cprofile-details">
                                        <form  @submit.prevent="profileUpdate" enctype="multipart/form-date">
							                <div class="form-group">
							                    <label>Full Name</label>
							                    <input type="text" class="form-control" v-model="EditProfile.fullName=customer.fullName" name="fullName" >
							                    <div v-if="EditProfile.errors.has('fullName')" v-html="EditProfile.errors.get('fullName')" />
							                </div>
							                <div class="form-group">
							                    <label>Phone</label>
							                    <input type="text"  class="form-control" name="phoneNumber" v-model="EditProfile.phoneNumber=customer.phoneNumber">
							                    <div v-if="EditProfile.errors.has('phoneNumber')" v-html="EditProfile.errors.get('phoneNumber')" />
							                </div>
							                <div class="form-group">
							                    <label>Email</label>
							                    <input type="text"  class="form-control" name="email"v-model="EditProfile.email=customer.email">
							                    <div v-if="EditProfile.errors.has('email')" v-html="EditProfile.errors.get('email')" />
							                </div>
							                <div class="form-group">
							                    <label>Address</label>
							                    <textarea class="form-control" name="address" v-model="EditProfile.address">{{customer.address}}</textarea>
							                </div>
							                <div class="form-group">
							                    <label>Image</label>
							                    <input type="file" class="form-control" name="image">
							                    <img :src="EditProfile.image=customer.image" alt="" style="width:50px; height:50px;border-radius: 50%;margin-top:5px;">
							                </div>
							                <div class="form-group">
							                    <input type="submit" class="btn btn-success" value="Save Change">
							                </div>
							            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	  </div>
</template>
<script>
import Sidebar from './Sidebar'
import Form from 'vform'
	export default{
        components : {
            Sidebar
        },
		data:() => ({
			customer : {},
			EditProfile: new Form({
 				fullName: '',
      			phoneNumber: '',
      			email: '',
      			address: '',
      			image: '',
			})
		}),
		methods:{
			loadData(){
				axios.get('/api/v1/customer/profile/edit?token='+localStorage.getItem('token')).then(response=>{
                    this.customer = response.data.customer;
                })
			},
			async profileUpdate () {
		      const response = await this.EditProfile.post('/api/v1/customer/profile/update',{
		      	headers:{
		      		Authorization: 'Bearer '+localStorage.getItem('token')
		      	}
		      }).then(response=>{
		        if(response.data.status=='success'){
		            this.$toast.success({
		                title:'Success!',
		                message:'Your profile update successfully.'
		            });
		            this.$router.push({name:'customeraccount'});
		        }else{
		            this.$toast.error({
		                title:'Opps!',
		                message:'Your data process something wrong'
		            });
		        }
		      })
		    }
		},
		mounted(){
            this.loadData();
        }
	};
</script>