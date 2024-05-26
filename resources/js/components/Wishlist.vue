<template>
	<div>
		<!--common html-->
        <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
	                        <sidebar></sidebar>
	                        <li><router-link :to="{name:'home'}"><i class="fa fa-home"></i> Home</router-link></li>
	                        <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
	                        <li><a class="anchor">Shopping <i class="fa fa-angle-right"></i></a></li>
	                        <li><a class="anchor">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
         <section class="productarea section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="show-cart-body">
                            <table class="table table-bordered wishlist table-responsive-sm">
                                  <thead class="wishlist-thead">
                                    <tr  class="thead-light">
                                      <th scope="col">Image</th>
                                      <th scope="col">Product</th>
                                      <th scope="col">Price</th>
                                      <th scope="col">Cart</th>
                                      <th scope="col">Delete</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr v-for="item in wishlist" :key="item.id">
                                      <td><div class="cart-img-box"><img :src="item.product.image.image" alt="" /> </div></td>
                                      <td>{{item.product.proName}}</td>
                                      <td>৳ {{item.product.proNewprice}}</td>
                                      <td class="text-left"><a @click="AddToCart(item.product)"  class="btn btn-primary anchor wishlist-addtocart-btn">Add To Cart</a></td>
                                      <td><button class="text-danger" @click="RemoveToWishlist(item.product)"><i class="fa fa-times"></i></button></td>
                                    </tr>
                                  </tbody>
                                </table>
                             </div>
                        </div>
                    </div>
                 <!--row end-->
            </div>
        </section>
        <!--productarea end-->
	</div>
</template>

<script>
    import sidebar from '../components/includes/sidebar'
    import {RemoveToWishlist,AddToCart} from '../mixin';
    export default {
    	components: {
    		sidebar,
    	},
        computed:{
            wishlist(){
                return this.$store.state.wishlist;
            }
        },
        mixins : [RemoveToWishlist,AddToCart],
    }
</script>