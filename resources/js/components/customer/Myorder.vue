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
                                <!-- col end -->
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <div class="cprofile-details table-responsive">
                                        <p class="account-title">My Order</p>
                                        <table class="table table-bordered">
                                            <thead class="text-white">
                                                <tr>
                                                    <td>Date</td>
                                                    <td>Tracking / Order No</td>
                                                    <td>Total Price</td>
                                                    <td>Status</td>
                                                    <td>Invoice</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(order,index) in orders">
                                                    <td>{{order.created_at}}</td>
                                                    <td>{{order.trackingId}}</td>
                                                    <td>BDT {{order.orderTotal}}</td>
                                                    <td>{{order.ordertype.name}}</td>
                                                    <td><router-link :to="{name:'orderinvoice',params:{id:order.orderIdPrimary}}" class="btn btn-success"><i class="fa fa-eye"></i></router-link></td>
                                                    <td>
                                                        <router-link :to="{name:'orderdetails',params:{id:order.orderIdPrimary}}" class="btn btn-primary">
                                                            View
                                                        </router-link>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
	export default{
        components:{
            Sidebar
        },
		data(){
			return{
				orders : [],
			}
		},
		methods:{
			loadData(){
				axios.get('/api/v1/customer/order/',{
					headers: {
						Authorization: 'Bearer ' + localStorage.getItem('token')
					}
				}).then(response=>{

                    this.orders = response.data.orders;
                    console.log(orders);
                });
			},
		},
		mounted(){
            this.loadData();
        }
	}
</script>