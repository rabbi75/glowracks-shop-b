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

        <section class="section-padding allshop-area">
        	<div class="container">
        		<div class="row justify-content-center">
    				<div class="col-sm-4 allshop" v-for="shoplist in allshops" :key="shoplist.id">
    					<div class="row no-gutters bg-white align-items-center border border-light rounded hov-shadow-md mb-3 has-transition">
						    <div class="col-4">
						        <a href="#" class="d-block p-3" tabindex="0">
						            <img
						                :src="shoplist.image"
						                :alt="shoplist.sellerName"
						                :title="shoplist.sellerName"
						                class="img-fluid lazyloaded"
						            />
						        </a>
						    </div>
						    <div class="col-8 border-left border-light">
						        <div class="p-3 text-left">
						            <h2 class="h6 fw-600 text-truncate">
						                <a href="#" class="text-reset" tabindex="0">{{shoplist.sellerName}}</a>
						            </h2>
						            <div class="rating rating-sm mb-2">
						            	<i class="fa fa-star"></i>
						            	<i class="fa fa-star"></i>
						            	<i class="fa fa-star"></i>
						            	<i class="fa fa-star"></i>
						            	<i class="fa fa-star"></i>
						            </div>
						            <router-link :to="{name:'shopspro', params: {slug:shoplist.slug}}" class="btn btn-soft-primary btn-sm">
						                Visit Store		                                
						                <i class="fa fa-angle-right angle-icon"></i>
		                            </router-link>						            
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
	export default{
		data(){
			return {
				allshops:[],
			}
		},
		methods:{
			loadSeller(){
				axios.get('api/v1/allshops').then(response=>{
					this.allshops = response.data.allshops;
				})
			}
		},
		mounted(){
			this.loadSeller();
		}
	};

</script>