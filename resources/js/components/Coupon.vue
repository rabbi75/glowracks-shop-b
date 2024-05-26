<template>
	<div>
		<div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
	                        <sidebar></sidebar>
	                        <li><router-link :to="{name:'home'}"><i class="fa fa-home"></i> Home</router-link></li>
	                        <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
	                        <li><a>Coupon Codes</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-padding">
        	<div class="container">
        		<div class="row justify-content-center">
    				<div class="col-sm-6" v-for="couponlist in couponcodes" :key="couponlist.id">
    					<div class="coupon-banner img-thumbnail">
    						<img :src="couponlist.image" alt="" />
    					</div>
    				</div>
        		</div>
        	</div>
        </section>
	</div>
</template>


<script>	
	export default{
		data(){
			return {
				couponcodes:[],
			}
		},
		methods:{
			loadCoupon(){
				axios.get('api/v1/coupon').then(response=>{
					this.couponcodes = response.data.couponcodes;
				})
			}
		},
		mounted(){
			this.loadCoupon();
		}
	};

</script>