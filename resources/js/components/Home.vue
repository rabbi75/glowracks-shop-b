<template>
    <div>
        <section class="menuandslider">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="sidebar-area">
                            <div class="sidebar-menu">
                                <ul v-if="categorylists.length > 0">
                                    <li v-for="category in categorylists" :key="category.id">
                                        <router-link :to="{name:'category', params: {slug:category.slug}}">
                                            <img :src="category.image" alt="" />
                                            {{category.name}}
                                            <i v-if="category.subcategories.length > 0" class="fa fa-caret-right"></i>
                                        </router-link>
                                        <ul class="sidebar-submenu" v-if="category.subcategories.length > 0">
                                            <li v-for="hsubcategory in category.subcategories" :key="hsubcategory.id">
                                                <router-link :to="{name:'subcategory', params: {slug:hsubcategory.slug}}">
                                                    {{hsubcategory.subcategoryName}}
                                                    <i v-if="hsubcategory.childcategories.length > 0" class="fa fa-caret-right"></i>
                                                </router-link>
                                                <ul class="sidebar-childmenu" v-if="hsubcategory.childcategories.length > 0">
                                                    <li v-for="childcategory in hsubcategory.childcategories" :key="childcategory.id">
                                                        <router-link :to="{name:'products',params:{slug:childcategory.slug}}">{{childcategory.childcategoryName}}</router-link>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="slider-area">
                            <div id="slider" class="main-slider">
                                <carousel :autoplay="true" :dots="false" :loop="true" :nav="false" :items="1" v-if="sliders.length > 0">
                                    <div class="slider-item" v-for="slider in sliders" :key="slider.id">
                                        <a :href="slider.burl" target="_self">
                                            <img :src="slider.image" alt="" />
                                        </a>
                                    </div>
                                </carousel>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--main slider section end-->
        <section class="hbrand-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <carousel autoplayTimeout="2000" :autoplay="true" :dots="false" :loop="true" :nav="false" :margin="15" :items="2" :responsive="{0:{items:2},786:{items:6},767:{items:4},400:{items:2}}" v-if="categorylists.length > 0">
                            <div class="brand-slider category-item" v-for="(category,index) in categorylists">
                                <div class="hcategory">
                                    <router-link :to="{name:'category',params:{slug:category.slug}}">
                                        <img :src="category.image" alt="" />
                                    </router-link>
                                </div>
                                <router-link :to="{name:'category',params:{slug:category.slug}}">
                                    <div class="category-title">
                                        <h3>{{category.name}}</h3>
                                    </div>
                                </router-link>
                            </div>
                        </carousel>
                    </div>
                </div>
            </div>
        </section>
        <!-- brand section ends -->
        <section>
            <div class="container">
                <div class="row light_bg">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-12">
                                    <div class="category-name">
                                        <a href="">All Products</a>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-8 col-12">
                                    <div class="pro_tab">
                                        <ul class="nav nav-tabs justify-content-lg-end" id="myTab" role="tablist">
                                            <li class="nav-item" v-for="(fcategory,index) in frontcategories" :key="fcategory.id">
                                                <a class="nav-link" :class="[index == 0 ? 'active' : '']" id="home-tab" data-toggle="tab" :href="'#home'+index" role="tab" aria-controls="home" aria-selected="true">{{fcategory.name}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content" id="myTabContent">
                            <div v-for="(fcategory,index) in frontcategories" :key="fcategory.id" class="tab-pane fade" v-bind:class="[index == 0 ? 'active show' : '']" :id="'home'+index" role="tabpanel" aria-labelledby="home-tab">
                                <div class="hproduct-area">
                                    <carousel :autoplay="true" :dots="false" :nav="false" :margin="10" :items="2" :responsive="{1200:{items:6},986:{items:5},786:{items:4},667:{items:3},400:{items:2}}" v-if="fcategory.products.length > 0">
                                        <template slot="prev">
                                            <span class="prev cust_prev"><i class="fa fa-angle-left"></i></span>
                                        </template>
                                        <template slot="next">
                                            <span class="next cust_next"><i class="fa fa-angle-right"></i> </span>
                                        </template>

                                        <div class="hproduct-item" v-for="(product,index) in fcategory.products">
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
                                                            <a @click="AddToWishlist(product)" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i  class="fa fa-heart"></i></a>
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
                                                            sold out
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </carousel>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- all product end -->
        <!-- top banner section -->
        <section class="top-banner-advertisement">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-6" v-for="(topitem, index) in topbanner">
                        <a :href="topitem.link" class="top-banner-link">
                            <div class="top-banner-box">
                                <img :src="topitem.image" alt="" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- top banner ends -->
        <!-- Trending Product Starts -->
        <section>
            <div class="container">
                <div class="row light_bg">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="category-name">
                                        <a href="">Trending Products</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="pro_tab">
                                        <ul class="nav nav-tabs justify-content-lg-end" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#featured" role="tab" aria-controls="home" aria-selected="true">Featured</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#bestseller" role="tab" aria-controls="home" aria-selected="true">Bestseller</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#latest" role="tab" aria-controls="home" aria-selected="true">Latest</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="featured" role="tabpanel" aria-labelledby="home-tab">
                                <div class="hproduct-area">
                                    <carousel :autoplay="true" :dots="false" :nav="false" :margin="10" :items="2" :responsive="{1200:{items:6},986:{items:5},786:{items:4},667:{items:3},400:{items:2}}" v-if="features.length > 0">
                                        <template slot="prev">
                                            <span class="prev cust_prev"><i class="fa fa-angle-left"></i></span>
                                        </template>
                                        <template slot="next">
                                            <span class="next cust_next"><i class="fa fa-angle-right"></i> </span>
                                        </template>

                                        <div class="hproduct-item" v-for="(product,index) in features">
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
                                                            sold out
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </carousel>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="bestseller" role="tabpanel" aria-labelledby="home-tab">
                                <div class="hproduct-area">
                                    <carousel :autoplay="true" :dots="false" :nav="false" :margin="10" :items="2" :responsive="{1200:{items:6},986:{items:5},786:{items:4},667:{items:3},400:{items:2}}" v-if="topsell.length > 0">
                                        <template slot="prev">
                                            <span class="prev cust_prev"><i class="fa fa-angle-left"></i></span>
                                        </template>
                                        <template slot="next">
                                            <span class="next cust_next"><i class="fa fa-angle-right"></i> </span>
                                        </template>

                                        <div class="hproduct-item" v-for="(product,index) in topsell">
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
                                                            sold out
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </carousel>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="latest" role="tabpanel" aria-labelledby="home-tab">
                                <div class="hproduct-area">
                                    <carousel :autoplay="true" :dots="false" :nav="false" :margin="10" :items="2" :responsive="{1200:{items:6},986:{items:5},786:{items:4},667:{items:3},400:{items:2}}" v-if="latests.length > 0">
                                        <template slot="prev">
                                            <span class="prev cust_prev"><i class="fa fa-angle-left"></i></span>
                                        </template>
                                        <template slot="next">
                                            <span class="next cust_next"><i class="fa fa-angle-right"></i> </span>
                                        </template>

                                        <div class="hproduct-item" v-for="(product,index) in latests">
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
                                                            sold out
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </carousel>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Trending Product end -->
        <!-- Special Category -->
        <div class="hproduct-area" v-for="(spcategory, index) in specialcat">
            <div class="container">
                <div class="row light_bg">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <div class="category-name">
                                        <a href="">{{spcategory.name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <carousel :autoplay="true" :dots="false" :nav="false" :margin="10" :items="2" :responsive="{1200:{items:6},986:{items:5},786:{items:4},667:{items:3},400:{items:2}}" v-if="features.length > 0">
                            <template slot="prev">
                                <span class="prev cust_prev"><i class="fa fa-angle-left"></i></span>
                            </template>
                            <template slot="next">
                                <span class="next cust_next"><i class="fa fa-angle-right"></i> </span>
                            </template>

                            <div class="hproduct-item" v-for="(product,index) in features">
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
                                                sold out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </carousel>
                    </div>
                </div>
            </div>
        </div>
        <!-- Special Category -->
        
        <section class="clientfeedback">
            <div class="container">
                <div class="row light_bg">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    <div class="category-name">
                                        <a href="">Client Feedback</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <carousel autoplayTimeout="3000" :autoplay="true" :dots="false" :loop="true" :nav="false" :margin="20" :items="1" :responsive="{0:{items:1},786:{items:2},767:{items:2},400:{items:1}}" v-if="feedbacks.length > 0">
                            <div class="brand-slider" v-for="feedback in feedbacks" :key="feedback.id">
                                <div class="testimonial-item">
                                    <div class="client-img">
                                        <img :src="feedback.image" alt="" />
                                    </div>
                                    <div class="clientName">
                                        <p>{{feedback.name}}</p>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                    </div>
                                    <div class="client_comment">
                                        <p>{{feedback.description}}</p>
                                    </div>
                                </div>
                            </div>
                        </carousel>
                    </div>
                </div>
            </div>
        </section>

        
        <!-- Button trigger modal -->
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
                                                                    <p><strong>Availability: </strong><span v-if="modalproduct.proQuantity > 0">In Stock</span> <span v-else>Sold Out</span></p>
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
                                                                    <button class="btn btn-secondary">Sold Out</button>
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
            </div>
        </section>
        <!-- Modal End -->
    </div>
</template>

<script>
    import PicZoom from "vue-piczoom";
    import carousel from "vue-owl-carousel";
    import CxltToastr from "cxlt-vue2-toastr";
    import { AddToCart, AddToWishlist, AddToCompare } from "../mixin";
    export default {
        components: {
            carousel,
            PicZoom,
        },
        data() {
            return {
                sliders: [],
                frontcategories: [],
                specialcat: [],
                categorylists: [],
                topsell: {},
                features: {},
                latests: {},
                brands: [],
                topbanner: [],
                feedbacks: [],
                modalproduct: {},
            };
        },
        methods: {
            loadData() {
                axios.get("/api/v1/top-banner").then((response) => {
                    this.topbanner = response.data.topbanner;
                });
                axios.get("/api/v1/category-list").then((response) => {
                    this.categorylists = response.data.categorylists;
                });
                axios.get("/api/v1/home-topsell").then((response) => {
                    this.topsell = response.data.topsell;
                });
                axios.get("/api/v1/home-featured").then((response) => {
                    this.features = response.data.features;
                });
                axios.get("/api/v1/home-latest").then((response) => {
                    this.latests = response.data.latests;
                });
                axios.get("/api/v1/client-feedback").then((response) => {
                    this.feedbacks = response.data.feedbacks;
                });
                axios.get("/api/v1/brands").then((response) => {
                    this.brands = response.data.brands;
                });
                axios.get("/api/v1").then((response) => {
                    this.frontcategories = response.data.frontcategories;
                    this.specialcat = response.data.specialcat;
                });
                axios.get("/api/v1/sliders").then((response) => {
                    this.sliders = response.data.sliders;
                });
            },
            AddToModal(product) {
                this.modalproduct = "";
                axios.get("/api/v1/modal/product/" + product.id).then((response) => {
                    this.modalproduct = response.data.modalproduct;
                });
            },
        },
        mounted() {
            this.loadData();
        },
        mixins: [AddToCart, AddToWishlist, AddToCompare],
    };
</script>
