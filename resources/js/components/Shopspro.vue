<template>
    <div>
        <!--common html-->
        <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                            <sidebar></sidebar>
                            <li>
                                <router-link :to="{name:'home'}"><i class="fa fa-home"></i> Home</router-link>
                            </li>
                            <li>
                                <a class="anchor"><i class="fa fa-angle-right"></i></a>
                            </li>
                            <li><a>{{shops.sellerName}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
        <section class="section-padding allshop-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 allshop" >
                        <div class="row no-gutters bg-white align-items-center border border-light rounded hov-shadow-md mb-3 has-transition">
                            <div class="col-4">
                                <a href="#" class="d-block p-3" tabindex="0">
                                    <img
                                        :src="shops.image"
                                        :alt="shops.sellerName"
                                        :title="shops.sellerName"
                                        class="img-fluid lazyloaded"
                                    />
                                </a>
                            </div>
                            <div class="col-8 border-left border-light">
                                <div class="p-3 text-left">
                                    <h2 class="h6 fw-600 text-truncate">
                                        <a href="#" class="text-reset" tabindex="0">{{shops.sellerName}}</a>
                                    </h2>
                                    <div class="rating rating-sm mb-2">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p v-html="shops.address">{{shops.address}}</p>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product -->
        <section class="productarea section-padding">
            <div class="container">
                <div class="row">                   
                    <!-- mobile sidebar -->
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="row hproduct-area">
                            <div class="col-lg-2 col-md-2 col-sm-6 col-6" v-for="(product,index) in products.data">
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
    import sidebar from "../components/includes/sidebar";
    import { AddToCart } from "../mixin";

    export default {
        components: {
            sidebar,
            AddToCart,
        },
        data() {
            return {
                shops: {},
                cart: [],
                products: {},
            };
        },
        methods: {
            loadProducts(page = 1) {
                let slug = this.$route.params.slug;

                axios.get("/api/v1/shopspro/" + slug + "?page=" + page).then((response) => {
                    this.products = response.data.products;
                    this.shops = response.data.shops;
                });               
            },
        },

        mixins: [AddToCart],
        mounted() {
            this.loadProducts();
        },
    };
</script>
