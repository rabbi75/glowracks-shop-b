<template>
	<div>
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
                                   <div class="order-details-inner">
                                   		<div class="order_head">
                                   			<h2>Tracking / Order No <span> #{{orderInfo.trackingId}}</span></h2>
                                   		</div>
                                   		<div class="order-summery">
                                   			<div class="row">
                                   				<div class="col-sm-4">
                                   					<div class="order_widget">
                                   						<p>Submitted at : {{orderInfo.created_at}}</p>
                                   						<p>Products Price : {{orderInfo.orderTotal - orderInfo.shipping.shippingfee}} Tk.</p>

                                   						<p>Discount : 0 Tk.</p>
                                   						<p>Delivery Charge : {{orderInfo.shipping.shippingfee}} Tk.</p>
                                   						<p>Note  : {{orderInfo.shipping.note}}</p>
                                   					</div>
                                   				</div>

                                   				<div class="col-sm-4">
                                   					<div class="order_widget">
                                   						<p>Shipping Slot : </p>
                                   						<p>Shipping Method : {{orderInfo.payment.paymentType}}</p>

                                   						<p>User Phone Number :{{orderInfo.shipping.phone}}</p>
                                   					</div>
                                   				</div>

                                   				<div class="col-sm-2">
                                   					<div class="order_widget">
                                   						<p>Current Status</p>
                                   						<h2>{{orderInfo.payment.paymentStatus}}</h2>
                                   					</div>
                                   				</div>

                                   				<div class="col-sm-2">
                                   					<div class="order_widget">
                                   						<p>Total</p>
                                   						<p>{{orderInfo.orderTotal}} Tk.</p>
                                   					</div>
                                   				</div>

                                   			</div>
                                   		</div>
                                   		 <div class="order_tab">
                                   	 <ul class="nav nav-pills mb-3 cust_tabbar" id="pills-tab" role="tablist">
										<li class="nav-item">
										<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#product_name" role="tab" aria-controls="product_name" aria-selected="true">Products</a>
										</li>
										<li class="nav-item">
										<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#address" role="tab" aria-controls="address" aria-selected="false">Address</a>
										</li>
										<li class="nav-item">
										<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tracking" role="tab" aria-controls="tracking" aria-selected="false">Tracking</a>
										</li>
									   </ul>
										<div class="tab-content" id="pills-tabContent">

										<div class="tab-pane fade show active" id="product_name" role="tabpanel" aria-labelledby="pills-home-tab">
											<table class="table table-bordered mt-30 cust_table">
	                                    	<thead>
	                                    		<tr>
	                                    			<td>Image</td>
	                                    			<td>Name</td>
	                                    			<td>Price</td>
	                                    			<td>Quantity</td>
	                                    			<td>TOTAL</td>
	                                    		</tr>
	                                    	</thead>
	                                    	<tbody>
	                                    		<tr v-for="(value,index) in orderInfo.orderdetails">
	                                    			<td><img :src="value.image.image" alt="" width="40"></td>
	                                    			<td class="d-proName">{{value.productName}}</td>
	                                    			<td>Tk {{value.productPrice}}</td>
	                                    			<td>{{value.productQuantity}}</td>
	                                    			<td>Tk {{value.productPrice*value.productQuantity}}</td>
	                                    		</tr>
	                                    	</tbody>
	                                    </table>
	                                    
										</div>

										<div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="pills-profile-tab">
											<div class="address_inner">
												<div class="row">
													<div class="col-sm-6">
														<div class="address_widget">
															<h4>Billing Address</h4>
															<p>Contact to: </p>
															<p>Telephone: {{orderInfo.shipping.phone}}</p>
															<p>Address: {{orderInfo.shipping.address}}</p>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="address_widget">
															<h4>Shipping Address</h4>
															<p>Contact to: </p>
															<p>Telephone: {{orderInfo.shipping.phone}}</p>
															<p>Address: {{orderInfo.shipping.address}}</p>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="tab-pane fade" id="tracking" role="tabpanel" aria-labelledby="pills-contact-tab">
											<div class="col-sm-12">
												<div class="row addpercel-inner">
													<div class="col-sm-8">
														<div class="track-left">
															<h4>TrackingID: {{orderInfo.trackingId}}
															</h4>
															 <div class="tracking-step" v-for="(value,index) in notes">
																<div class="tracking-step-left">
																	<strong>{{value.updated_at}}</strong>
																	<p>{{value.created_at}}</p>
																</div>
																<div class="tracking-step-right">
																	<p>{{value.note}}</p>
																</div>
															</div>
														</div>
													</div>
													<div class="col-sm-7">
													</div>
												</div>
											</div>
										 </div>
										</div>
                                   </div>
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
	export default {
		components:{
            Sidebar
        },
         data(){
       	return{
       		 logo:{},
       		 orderInfo:[],
       		 notes:[],
       	}
       },
        methods:{
            loadData(){
            	let id = this.$route.params.id;
                axios.get('/api/v1/customer/order/invoice/'+id,{
                	headers: {
						Authorization: 'Bearer ' + localStorage.getItem('token')
					}
                }).then(response => {
                	 this.orderInfo = response.data.orderInfo;
                });
                axios.get('/api/v1/logo').then(response => {
                	 this.logo = response.data.logo;
                });
                axios.get('/api/v1/customer/order/note/'+id,{
                	headers: {
						Authorization: 'Bearer ' + localStorage.getItem('token')
					}
                }).then(response => {
                	 this.notes = response.data.notes;
                });
            },
        },
        mounted(){
            this.loadData();
        }

	}


</script>