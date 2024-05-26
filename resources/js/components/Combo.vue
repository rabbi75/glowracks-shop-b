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
                        <li><a>Offer Product</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
    	<section class="productarea section-padding">
            <div class="container">
                <div class="row">
                  <div class="col-lg-3 col-sm-3 pc-sidebar">
                    <div class="sidebar">
                      <div class="custom-tree">
                        <div class=" title ">
                          <h6>Price</h6>
                        </div>
                          <form @submit.prevent="priceFilter">
                              <input type="text" v-model="minprice" name="minprice" placeholder="Min" class="width40 minprice">
                              <input type="text" v-model="maxprice" name="maxprice" placeholder="Max" class="width40 maxprice">
                               <button type="submit" class="width20">Send</button>
                          </form>
                        </div>
                    </div>
                    <div class="sidebar">
                      <div class="custom-tree">
                        <div class=" title ">
                          <h6>Product category</h6>
                        </div>
                         <ul class="mtree transit" v-if="categories.length > 0">
                            <li v-for="(category,index) in categories">
                            <router-link :to="{name:'category', params: {slug:category.slug}}">
                            {{category.name}} <span>(10)</span> </router-link>
                            </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!-- pc sidebar end -->
                  <div class="col-lg-3 col-sm-3 mobile-sidebar">
                      <div class="bs-example">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne">Product Category <span><i class="fa fa-caret-up"></i></span></button>									
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="sidebar">
                                          <div class="custom-tree">
                                              <ul class="mtree transit">
                                                <li v-for="(category,index) in categories"><router-link :to="{name:'category', params:{slug: category.slug}}">{{category.name}} <span>(10)</span></router-link>
                                                </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree">Price <span><i class="fa fa-caret-up"></i></span></button>                     
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="sidebar">
                                          <div class="custom-tree">
                                              <form action="" id="pricefilter">
                                                @csrf
                                                  <input type="text" name="minprice" placeholder="Min" class="width40 minprice">
                                                  <input type="text" name="maxprice" placeholder="Max" class="width40 maxprice">
                                                   <button type="submit" class="width20">Send</button>
                                              </form>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- mobile sidebar -->
                   <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="category-bar">
                        <div class="row">
                          <div class="col-sm-8">
                            <h4> Combo Product</h4>
                          </div>
                          <div class="col-sm-4">
                            <div class="sort-form">
                              <select  class="form-control"  @change="productSort()" v-model="sort">
                                  <option value="">Default</option>
                                      <option value="1" >Newest</option>
                                      <option value="2" >Oldest</option>
                                      <option value="4" >Price: (Low > High)</option>
                                      <option value="3" >Price: (High > Low)</option>
                                      <option value="6">A > Z</option>
                                      <option value="5">Z > A</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row hproduct-area">
                           <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="(product,index) in products.data">
                                <div class="hproduct-item">
                                    <router-link :to="{name:'productdetails', params:{id:product.id,slug:product.slug}}">
                                        <div class="hproduct-img">
                                            <img :src="product.image.image" alt="" />
                                            <p class="discount" v-if="product.proOldprice">
                                                {{product.proOldprice - product.proNewprice}} Tk OFF
                                            </p>
                                        </div>
                                    </router-link>
                                    <div class="hproduct-info">
                                        <p class="hproduct-name">
                                            <router-link :to="{name:'productdetails', params:{id:product.id,slug:product.slug}}">
                                                {{product.proName.substring(0,40)}} 
                                            </router-link></p>
                                        <p class="hproduct-price">৳ {{product.proNewprice}} 
                                            <span v-if="product.proOldprice"> ৳ {{product.proOldprice}}</span>
                                        </p>
                                    </div>
                                    <div class="product-cart">
                                        <ul>
                                            <li v-if="product.proQuantity > 1">
                                                <a @click="AddToCart(product)">
                                                    add to cart
                                                </a>
                                            </li>
                                            <li v-else>
                                                <a class="stock-out">
                                                    stock out
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                          </div>
                           <!-- product col 3 end -->
                           <div class="col-sm-12">
                               <pagination :data="products" @pagination-change-page="loadProducts"></pagination>
                           </div>
                       </div>
                    </div>
                    <!--col end-->
                </div>
            </div>
        </section>
        <!--productarea end-->
    </div>
</template>
<script>
   import sidebar from '../components/includes/sidebar'
   import {AddToCart} from '../mixin'
    export default {
    	components: {
    		sidebar,
            AddToCart
    	},
        data(){
            return {
                categories:[],
                cart:[],
                products:{},
                sort: ""
            }
        },
        methods:{
            loadProducts(page=1){
                axios.get('/api/v1/combo/'+'?page='+page).then(response => {
                	 this.products = response.data.products;
                });
                 axios.get('/api/v1/all-category').then(response => {
                     this.categories = response.data.categories;
                })
            },
            productSort(page=1){
             let slug = this.$route.params.slug;
             let sort = this.sort;
              axios.get('/api/v1/combo/'+'?sort='+sort).then(response => {
                     this.products = response.data.products;
                });
            }

        },
        mixins: [AddToCart],
        mounted(){
            this.loadProducts();
        }
    };
</script>