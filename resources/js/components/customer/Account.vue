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
                            <li><a class="anchor">Customer Profile</a></li>
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
                                <div class="col-lg-9 col-sm-9 col-md-9">
                                    <div class="cprofile-info">
                                        <div class="row">
                                             <div class="col-md-4 col-sm-6 col-6 mb-1 mt-1">
                                                <div class="counter-item bg-1">
                                                    <div class="counter-item-left">
                                                      <p><i class="fa fa-shopping-basket"></i></p>
                                                    </div>
                                                    <div class="counter-item-right">
                                                      <p> Total Order</p>
                                                      <h5>{{order_accepted}}</h5>
                                                    </div>
                                                   </div>
                                                </div>
                                             <div class="col-md-4 col-sm-6 col-6 mt-1">
                                                <div class="counter-item bg-2">
                                                    <div class="counter-item-left">
                                                      <p><i class="fa fa-spinner"></i></p>
                                                    </div>
                                                    <div class="counter-item-right">
                                                      <p>Running Order</p>
                                                      <h5>{{order_running}}</h5>
                                                    </div>
                                                  </div>
                                              </div>
                                             <div class="col-md-4 col-sm-6 col-6 mt-1">
                                                <div class="counter-item bg-3">
                                                    <div class="counter-item-left">
                                                      <p><i class="fa fa-times-circle"></i></p>
                                                    </div>
                                                    <div class="counter-item-right">
                                                      <p>Cancel order</p>
                                                      <h5>{{order_cancel}}</h5>
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="cprofile-chart">
                                                      <div class="card-body">
                                                        <canvas id="myChart"></canvas>
                                                      </div>
                                                  </div>
                                              </div>

                                             <div class="col-md-6 mt-4">
                                                <div class="cprofile-details">
                                                    <p class="account-title">Account Information</p>
                                                    <table class="table table-bordered">
                                                      <thead>
                                                        <tr>
                                                          <th scope="col">Information</th>
                                                          <th scope="col"><router-link :to="{name:'editprofile'}" class="anchor"><i class="fa fa-edit"></i> Edit</router-link></th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <th scope="row">Image</th>
                                                          <td><img :src="customer.image" alt="" style="width:50px; height:50px;border-radius: 50%"></td>
                                                        </tr>
                                                        <tr>
                                                        <tr>
                                                          <th scope="row">Name</th>
                                                          <td>{{customer.fullName}}</td>
                                                        </tr>
                                                        <tr>
                                                          <th scope="row">Phone</th>
                                                          <td>{{customer.phoneNumber}}</td>
                                                        </tr>
                                                        <tr>
                                                          <th scope="row">Email</th>
                                                          <td>{{customer.email}}</td>
                                                        </tr>
                                                        <tr>
                                                          <th scope="row">Address</th>
                                                          <td>{{customer.address}}</td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                           </div>
                                    </div>
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
import Sidebar from './Sidebar'
	export default{
        components:{
            Sidebar
        },
		data(){
			return{
				customer : {},
                order_accepted : {},
                order_running : {},
                order_cancel : {},
			}
		},
		methods:{
			loadData(){
				axios.get('/api/v1/customer/account/',{
					headers: {
						Authorization: 'Bearer ' + localStorage.getItem('token')
					}
				}).then(response=>{
                    this.customer = response.data.customer;
                })
                axios.get('/api/v1/customer/account/overview',{
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }).then(response=>{
                    this.order_accepted = response.data.order_accepted;
                    this.order_running = response.data.order_running;
                    this.order_cancel = response.data.order_cancel;
                })
			},
		},
		mounted(){
            this.loadData();
        }
	}
    

</script>

