<template>
	<div>
		<!--common html-->
		<section class="invoice-section">
		    <div class="container">
		        <div class="row">
		        	<div class="col-12">
		        		<button @click="print" class="invoice-print-btn"><i class="fa fa-print"></i></button>
		        	</div>
		            <div class="paddleft-120 col-lg-12 col-md-12 col-sm-4">
		                <div class="customer-profile">
	                        <!-- col end -->
	                        <div class="col-lg-12 col-md-12 col-sm-12">
	                            <div class="invoice">
	                                <div class="invoice-box" id="printDivone">
	                                	<div class="invoice-logo-part">
	                                		<div class="bill-from-box text-left" v-for="(info, index) in contact">
                                    			<h4 class="bill-from-title">BILL FROM:</h4>
                                    			<p v-for="config in config">{{ config.sitename }}</p>
                                    			<p>{{ info.address }}</p>
                                    			<p>{{ info.email }}</p>
                                    			<p>Helpline: +8801999-848484, +8809611-848484</p>
                                    		</div>
                                    		<div class="invoice-logo">
                                    			<img :src="logo.invoice" alt="">
                                    		</div>
	                                	</div>
	                                	<div class="invoice-info-part">
	                                		<div class="bill-to-box text-left">
		                                    	<h4 class="bill-from-title">BILL TO:</h4>
	                                			<b>{{orderInfo.shipping.name}}</b>
	                                			<p>{{ orderInfo.customer.address}}</p>
	                                			<p>Delivery Location: <strong>{{orderInfo.shipping.address}}</strong></p>
	                                			<p>{{ orderInfo.shipping.phone }}</p>
		                                    </div>
		                                    <div class="order-info-box">
		                                    	<p class="order-number">
		                                    		<strong>ORDER NUMBER: </strong>
		                                    		#{{ orderInfo.orderIdPrimary }}
		                                    	</p>
		                                    	<p class="order-date">
		                                    		<strong>ORDER DATE:</strong>
		                                    		{{ orderInfo.created_at }}
		                                    	</p>
		                                    	<div class="payment-due">
	                                    			<strong class="method">Payment Method: </strong>
	                                    			<h3 class="cod" v-if="orderInfo.payment.paymentType  == 'cod'">Cash On Delivery</h3>
	                                    			<h3 class="text-uppercase bkash-rocket" v-else>{{ orderInfo.payment.paymentType }}</h3> 
	                                    			- 
	                                    			<strong class="due">AMOUNT DUE: </strong>
	                                    			<span class="amount" v-if="orderInfo.payment.paymentStatus == 'Paid'">BDT 0</span>
	                                    			<span class="amount" v-else>BDT {{orderInfo.orderTotal}}</span>
		                                    	</div>
		                                    </div>
	                                	</div>	                                    
	                                    <table class="table mt-30">
	                                    	<thead>
	                                    		<tr>
	                                    			<td>Item</td>
	                                    			<td>Unit Price</td>
	                                    			<td>Quantity</td>
	                                    			<td>Total</td>
	                                    		</tr>
	                                    	</thead>
	                                    	<tbody>
	                                    		<tr v-for="(value,index) in orderInfo.orderdetails" style="border-bottom: 1px solid #ddd">
	                                    			<td>{{ value.productName }}</td>
	                                    			<td>BDT {{ value.productPrice }} </td>
	                                    			<td>{{ value.productQuantity }}</td>
	                                    			<td style="white-space: nowrap;">BDT {{ value.productPrice*value.productQuantity }}</td>
	                                    		</tr>
	                                    	</tbody>
	                                    </table>
	                                    <div class="invoice-total-part">
	                                		<div class="order-note-box text-left" v-for="(info, index) in contact">
                                    			<h4 class="bill-from-title">Order Note :</h4>
                                    			<p>{{ note.note }}</p>	
                                    			<p>Created by: Mirror E-commerce  Team. </p>	
                                    		</div>
                                    		<div class="total-box">
                                    			<p>
                                    				<strong>Subtotal : </strong>
	                                    			BDT {{ orderInfo.orderTotal - orderInfo.shipping.shippingfee + orderInfo.discount }}
	                                    		</p>
                                    			<p>
                                    				<strong>Shipping (+) :</strong>
                                    				BDT {{ orderInfo.shipping.shippingfee }}
                                    			</p>
                                    			<p>
                                    				<strong>Discount (-) :</strong>
                                    				BDT {{ orderInfo.discount }}
                                    			</p>
                                    			<div class="payment-due">
                                    				<p>                                    					
	                                    				<strong>Total : </strong>BDT {{ orderInfo.orderTotal }}
                                    				</p>
		                                    	</div>
                                    		</div>
	                                	</div>
	                                	<div class="thanks-giving">
	                                		<p>Thank you for ordering Mirror Lifestyle. We offer a 3-day return policy on all products. If you have any complaint about this order, Please call or email us. bKash Payment Number: 01970597767</p>
	                                	</div>
	                                	<div class="powered-by">
	                                		<p class="powered">Powered by Mirror Lifestyle</p>
	                                		<p class="domain">mirror-bd.com</p>
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
<style>
	.invoice-print-btn
	{
	    background-color: #f94b01;
	    padding: 6px 15px;
	    border-radius: 5px;
	    margin-top: 10px;
	    color: #fff;
	    transition: all 0.3s ease;
	    border: 2px solid #f94b01;
	}
	.invoice-print-btn:focus, 
	.invoice-print-btn:hover 
	{
	    border: 2px solid #f94b01;
	    color: #f94b01;
	    background-color: #fff;
	}
	section.invoice-section {
	    background: #f9f9f9;
	}
	table{
		overflow: hidden;
	}
	.brt-0 {
	    border: 0 !important;
	}
	.brl-1 {
	    border-left: 1px solid #eee !important;
	}
	.pad-30{
		padding: 30px;
	}
	.invoice-logo img {
	    width: 100px;
	    height: auto;
	}
	.float-left{
		float: left;
	}
	.float-right{
		float: right;
	}
	.w-33{
		width: 33.00%;
	}
	.w-47{
		width: 47%;
	}
	.mt-50{
		margin-top: 50px;
	}
	.mt-30{
		margin-top: 30px;
		margin-bottom: 0 !important;
	}
	p.invoice-title {
	    font-size: 24px;
	    font-weight: 800;
	    color: #f94b01;
	    letter-spacing: 3px;
	}
	.invoice .name {
	    color: #f94b01;
	    font-weight: 600;
	}
	.invoice {
        max-width: 950px;
        margin: 0px auto;
        overflow: hidden;
        margin-top: 20px;
        margin-bottom: 50px;
    }

	.invoice-box {
	    padding: 30px;
	    background: #fff;
	    font-size: 16px;
	    line-height: 24px;
	    color: #555;
	    position: relative;
	    overflow: hidden;
	    padding-bottom: 70px;
	    /*border-top: 15px solid #f94b01;*/
	    position: relative;
    	z-index: 1;
	}
	.invoice-box:before,
	.invoice-box:after {
		content: '';
	    /*background: #f94b01;*/
	    height: 60px;
	    width: 60px;
	    position: absolute;
	}
	.invoice-box:after {
	    left: 0;
	    top: 0;
	}
	.invoice-box:before {
	    left: 8px;
	    top: 8px;
	    opacity: 0.8;
	}
    .invoice-box table thead {
	    background: #dddddd;
	    color: #fff;
	}
    .invoice-box table thead td {
	    color: #f94b01;
	    font-weight: 700;
	    white-space: nowrap;
	}
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    .invoice-footer table {
	    width: 100%;
	}
    .table td, .table th {
        padding: 8px 10px;
    }
    .grandtotal {
	    background: #f94b01;
	    color: #fff;
	}
    .grandtotal td {
	    padding: 8px 10px;
	}
	.invoice-footer {
	    background: #f94b01;
	    color: #fff;
	    padding: 30px 30px;
	    position: relative;
	    z-index: 1;
	}
	.invoice-footer:after {
	    position: absolute;
	    right: -23px;
	    top: -38px;
	    height: 150px;
	    width: 150px;
	    content: "";
	    background: #f94b01;
	    border-radius: 73px;
	    z-index: -1;
	}
	.icon {
	    float: left;
	    width: 30px;
	    background: #fff;
	    height: 30px;
	    border-radius: 50%;
	    margin-right: 15px;
	    margin-top: 10px;
	    display: flex;
	    justify-content: center;
	    align-items: center;
	}
	.contact-info {
	    float: left;
	    width: 83%;
	    text-align: left;
	}
	.icon i {
	    color: #f94b01;
	    line-height: 30px;
	}



	.bill-to-box p,
	.bill-from-box p {
	    margin: 0;
	    max-width: 350px;
	}
	h4.bill-from-title {
	    color: #f94b01;
	    margin: 0;
	    font-size: 1.2rem;
	}
	.invoice-logo-part, .invoice-info-part, .invoice-total-part {
	    display: flex;
	    justify-content: space-between;
	    margin-top: 30px;
	}
	.order-info-box {
	    text-align: right;
	}
	.order-info-box p {
	    margin-bottom: 20px;
	}
	.order-info-box p strong {
	    font-size: 1rem;
	    color: #f94b01;
	}
	.payment-due {
	    display: flex;
	    justify-content: flex-end;
	    background-color: #ddd;
	    align-items: center;
	    padding-right: 10px;
	    width: 500px;
	    height: 37px;
	}
	.payment-due p, 
	.payment-due h3 {
		margin: 0;
	}
	.payment-due strong {
	    color: #f94b01;
	    padding: 0 5px;
	}
	h3.cod {
	    font-size: 1rem;
	    padding-left: 5px;
	    padding-right: 5px;
	}
	.total-box p {
	    text-align: right;
	    margin: 10px;
	}
	.total-box p strong {
	    color: #f94b01;
	}
	.order-note-box p {
	    margin-top: 20px;
	}
	.thanks-giving {
	    border-bottom: 1px solid #ddd;
	    border-top: 1px solid #ddd;
	    padding: 25px 0;
	    margin: 25px 0;
	}
	.thanks-giving p {
	    margin: 0;
	    text-align: center;
	}
	.powered-by .powered,
	.powered-by .domain {
	    text-align: center;
	    font-size: 1.1rem;
	    color: #f94b01;
	    margin-top: 20px;
	    font-weight: 900;
	}
	.powered-by .domain {
	    font-size: 0.9rem;
	    margin-top: 0;
	}

	@media print {
	  body * {
	    visibility: hidden;
	  }
	  #printDivone, 
	  #printDivone * {
	    visibility: visible;
	  }
	  #printDivone {
	    position: absolute;
	    left: 0;
	    top: 0;
	  }
	}
</style>
<script>
    export default {
       data(){
       	return{
       		 logo:{},
       		 orderInfo:[],
       		 contact:[],
       		 config:[],
       		 note:{},
       		 discount: localStorage.getItem('discount'),
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
                	this.note = response.data.note;
                });
                axios.get('/api/v1/logo').then(response => {
                	this.logo = response.data.logo;
                });
                axios.get('/api/v1/contact-us').then(response => {
                	this.contact = response.data.contact;
                });
                axios.get('/api/v1/config').then(response => {
                	this.config = response.data.config;
                });
            },
            print(){
            	window.print();
            }
        },
        mounted(){
            this.loadData();
        }
    }
</script>
