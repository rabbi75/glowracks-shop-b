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
                            <li><router-link :to="{name: 'products', params: {slug: childcategory.slug}}">{{childcategory.childcategoryName}}</router-link></li>
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
                                <div class="title">
                                    <h6>Price</h6>
                                </div>
                                <form @submit.prevent="priceFilter">
                                    <input type="text" v-model="minprice" name="minprice" placeholder="Min" class="width40 minprice" />
                                    <input type="text" v-model="maxprice" name="maxprice" placeholder="Max" class="width40 maxprice" />
                                    <button type="submit" class="width20">Send</button>
                                </form>
                            </div>
                        </div>
                        <Sidecategory></Sidecategory>
                    </div>
                    <!-- pc sidebar end -->
                    <div class="col-lg-3 col-sm-3 mobile-sidebar">
                        <div class="mobile-filter">
                            <div class="row light_bg">
                                <div class="col-4">
                                    <a class="open-login open_filter" @click="SidebarFilter()"><i class="fas fa-sort-amount-down"></i> Filter </a>
                                </div>
                                <div class="col-8">
                                    <div class="sort-form filter-short-form">
                                        <span class="sortBy">Sort By: </span>
                                        <select class="form-control" @change="productSort()" v-model="sort">
                                            <option value="">Default</option>
                                            <option value="1">Newest</option>
                                            <option value="2">Oldest</option>
                                            <option value="4">Price: (Low > High)</option>
                                            <option value="3">Price: (High > Low)</option>
                                            <option value="6">A > Z</option>
                                            <option value="5">Z > A</option>
                                        </select>
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
                                    <h4>{{childcategory.childcategoryName}}</h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="sort-form">
                                        <select class="form-control" @change="productSort()" v-model="sort">
                                            <option value="">Default</option>
                                            <option value="1">Newest</option>
                                            <option value="2">Oldest</option>
                                            <option value="4">Price: (Low > High)</option>
                                            <option value="3">Price: (High > Low)</option>
                                            <option value="6">A > Z</option>
                                            <option value="5">Z > A</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hproduct-area">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6" v-for="(product,index) in products.data">
                                <div class="hproduct-item">
                                    <div class="hproduct-img">
                                        <router-link :to="{name:'productdetails', params:{id:product.id,slug:product.slug}}">
                                            <img :src="product.image.image" alt="" />
                                        </router-link>
                                        <p class="discount" v-if="product.proOldprice">
                                            - {{product.proOldprice - product.proNewprice}} Tk
                                        </p>
                                        <div class="hproduct-img-icon">
                                            <ul>
                                                <li>
                                                    <a @click="AddToCompare(product)"><i class="fa fa-random"></i></a>
                                                </li>
                                                <li>
                                                    <a @click="AddToWishlist(product)"><i class="fa fa-heart"></i></a>
                                                </li>
                                                <li>
                                                    <a @click="AddToModal(product)" type="button" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hproduct-info">
                                        <p class="hproduct-name">
                                            <router-link :to="{name:'productdetails', params:{id:product.id,slug:product.slug}}">
                                                {{product.proName.substring(0,40)}}
                                            </router-link>
                                        </p>
                                        <p class="hproduct-price">
                                            ৳ {{product.proNewprice}}
                                            <span v-if="product.proOldprice"> ৳ {{product.proOldprice}}</span>
                                        </p>
                                    </div>
                                    <div class="product-cart">
                                        <ul>
                                            <li v-if="product.proQuantity > 1">
                                                <a @click="AddToCart(product)">
                                                    add to bag
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
        <div class="customer-sidebar">
            <div class="overlay"></div>
            <div class="filtersidebar">
                <div class="customer-register">
                    <div class="title">
                        <h5>My Filter</h5>
                        <a class="remove_filter" @click="SidebarFilter()">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>

                <div class="sidebar">
                    <div class="custom-tree">
                        <div class="title">
                            <h6>Price</h6>
                        </div>
                        <form @submit.prevent="priceFilter">
                            <input type="text" v-model="minprice" name="minprice" placeholder="Min" class="width40 minprice" />
                            <input type="text" v-model="maxprice" name="maxprice" placeholder="Max" class="width40 maxprice" />
                            <button type="submit" class="width20">Send</button>
                        </form>
                    </div>
                </div>
                <Sidecategory></Sidecategory>
            </div>
        </div>
        <!-- Modal Start-->
        <section>
            <div class="row">
                <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="modal fade modal-widget" id="productModal" tabindex="-1" role="dialog" aria-labelledby="modalproductLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header-view">
                                    <button type="button" class="close-view" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="quickview-area">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <div class="quickview-item-left">
                                                            <div class="card-carousel">
                                                                <div class="dslider-big">
                                                                    <carousel :autoplay="true" :dots="false" :loop="true" :nav="false" :items="1" v-if="modalproduct.images">
                                                                        <div class="product-img-item" v-for="(image,index) in modalproduct.images" :key="image.id">
                                                                            <img :src="image.image" alt="" />
                                                                        </div>
                                                                    </carousel>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <div class="quickview-item-right">
                                                            <p class="product-name">{{modalproduct.proName}}</p>
                                                            <div class="pro-highlight">
                                                                <div class="pro-highlight-left">
                                                                    <div class="review right">
                                                                        <ul>
                                                                            <li>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <span>{{modalproduct.reviews_count}} Review(s)</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <p><strong>SKU: </strong>{{modalproduct.proCode}}</p>
                                                                </div>
                                                                <div class="pro-highlight-right">
                                                                    <p><strong>Availability: </strong><span v-if="modalproduct.proQuantity > 0">In Stock</span> <span v-else>Stock Out</span></p>
                                                                    <p><strong>Brand: </strong><span v-if="modalproduct.brand">{{modalproduct.brand.brandName}}</span></p>
                                                                </div>
                                                            </div>
                                                            <div class="details-pro-price view">
                                                                <span>৳</span>
                                                                <span>{{modalproduct.proNewprice}} <del v-if="modalproduct.proOldprice">{{modalproduct.proOldprice}}</del></span>
                                                            </div>
                                                            <div class="details-quantity-area">
                                                                <div class="view-description">
                                                                    <p v-html="modalproduct.shortDescription"></p>
                                                                </div>

                                                                <div v-if="modalproduct.proQuantity > 1">
                                                                    <div class="details-cart-part">
                                                                        <div class="cart-button-box">
                                                                            <button class="dbutton addcart view" @click="AddToCart(modalproduct)">Add To Bag</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="view-button">
                                                                        <ul>
                                                                            <li>
                                                                                <button type="button" class="btn-this" @click="AddToWishlist(modalproduct)"><i class="fa fa-heart"></i>ADD TO WISH</button>
                                                                            </li>
                                                                            <li>
                                                                                <button type="button" class="btn-this" @click="AddToCompare(modalproduct)"><i class="fa fa-random"></i>COMPARE THIS</button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div v-else>
                                                                    <button class="btn btn-secondary">Stock Out</button>
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
                <!-- Modal End -->
            </div>
        </section>
    </div>
</template>
<script>
    import sidebar from "../components/includes/sidebar";
    import Sidecategory from "../components/includes/Sidecategory";
    import { AddToCart, AddToWishlist, AddToCompare, SidebarFilter } from "../mixin";
    export default {
        components: {
            sidebar,
            Sidecategory,
            AddToCart,
        },
        data() {
            return {
                childcategory: {},
                categories: [],
                cart: [],
                products: {},
                sort: "",
                minprice: "",
                maxprice: "",
                modalproduct: {},
            };
        },
        methods: {
            loadProducts(page = 1) {
                let slug = this.$route.params.slug;
                axios.get("/api/v1/products/" + slug + "?page=" + page).then((response) => {
                    this.products = response.data.products;
                    this.childcategory = response.data.childcategory;
                    this.categories = response.data.categories;
                });
            },
            loadCategory() {
                axios.get("/api/v1/categories").then((response) => {
                    this.categories = response.data.categories;
                });
            },
            productSort(page = 1) {
                let slug = this.$route.params.slug;
                let sort = this.sort;
                axios.get("/api/v1/products/" + slug + "?sort=" + sort).then((response) => {
                    this.products = response.data.products;
                });
            },
            priceFilter(page = 1) {
                let slug = this.$route.params.slug;
                let minprice = this.minprice;
                let maxprice = this.maxprice;
                axios.get("/api/v1/products/" + slug + "?minprice=" + minprice + "&&maxprice=" + maxprice).then((response) => {
                    this.products = response.data.products;
                });
            },
            AddToModal(product) {
                this.modalproduct = "";
                axios.get("/api/v1/modal/product/" + product.id).then((response) => {
                    this.modalproduct = response.data.modalproduct;
                });
            },
        },
        mixins: [AddToCart, AddToWishlist, AddToCompare, SidebarFilter],
        mounted() {
            this.loadProducts();
            this.loadCategory();
        },
    };
</script>
