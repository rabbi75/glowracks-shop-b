<template>
    <div class="app-body">
        <!-- topbar -->
        <section class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-md-4">
                        <div class="top-widget">
                            <div class="top-widget-left">
                                <ul>
                                    <li v-for="(value,index) in contact">
                                        <a href="#">Email: {{value.email}} </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 col-md-8">
                        <div class="top-widget">
                            <div class="top-widget-right">
                            <ul>
                            <li v-if="isLoggedIn">
                            <div class="custom-dropdown">
                                <button onclick="myFunction()" class="dropbtn">My Account <i class="fa fa-angle-down"></i></button>
                                <div id="myDropdown" class="dropdown-content">
                                    <router-link :to="{name:'customeraccount'}">My Dashboard</router-link>
                                    <router-link :to="{name:'myorder'}">My Orders</router-link>
                                    <a href="" @click.prevent="logout">Logout</a>
                                </div>
                            </div>
                            </li>

                            <li v-else>
                              <div class="custom-dropdown">
                                <button onclick="myFunction()" class="dropbtn">My Account <i class="fa fa-angle-down"></i></button>
                                <div id="myDropdown" class="dropdown-content">
                                   <router-link :to="{name:'register'}">
                                        <i class="fa fa-address-book"></i> Register
                                    </router-link>

                                    <router-link :to="{name:'login'}">
                                        <i class="fa fa-sign-in-alt"></i> Login
                                    </router-link>
                                </div>
                               </div>
                            </li> 
                            <li><router-link :to="{name:'home'}">Home</router-link></li>
                            <li><router-link :to="{name:'offer'}">Offer</router-link></li>
                            <li><router-link :to="{name:'trackform'}">Track Order</router-link></li>
                            <li><router-link :to="{name:'coupon'}">Coupons</router-link></li>
                            </ul>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./topbar -->
        <header class="header-section" id="myHeader">
            <div class="main-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                            <div class="logo">
                                <router-link :to="{name:'home'}">
                                    <img :src="logo.image" alt="" /></router-link>
                            </div>
                        </div>
                        <!--col end-->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="main-search">
                                <form>
                                    <input type="text" name="keyword" v-on:keyup="search()" v-model="keyword" class="search_data" placeholder="Search here..." />
                                    <button type="submit" @click.stop.prevent="submit()"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 cl-5">
                            <div class="widget-info-area">
                                <ul>
                                    <li><router-link :to="{name:'compare'}" class="widget-item"><i class="fa fa-random"></i><sup>{{compareCount}}</sup></router-link></li>
                                    <li><router-link :to="{name:'wishlist'}" class="widget-item"><i class="fa fa-heart"></i><sup>{{wishlistCount}}</sup></router-link></li>
                                    <li><router-link :to="{name:'showcart'}" class="widget-item"><i class="fa fa-shopping-bag"></i><sup>{{cartItemCount}}</sup></router-link></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main header end -->
            <section class="d-none d-sm-block main-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="main-menu">
                                <ul>
                                    <li class="sidebar-container-menu">
                                        <a class="category anchor" id="hovercategory">
                                            <i class="fa fa-bars"></i>
                                            categories
                                        </a>
                                        <sidebar></sidebar>
                                    </li>
                                    <li><router-link :to="{name:'offer'}">Offer</router-link></li>
                                    <li><router-link :to="{name:'trackform'}">Track Order</router-link></li>
                                    <li><router-link :to="{name:'coupon'}">Coupons</router-link></li>
                                    <li><router-link :to="{name:'feeback'}">Feedback</router-link></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="mobile-header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <div class="mlogo">
                                <router-link :to="{name:'home'}">
                                    <img :src="logo.image" alt="" />
                                </router-link>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="msearch">
                                <button @click="searchShow = !searchShow"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="mobile-rmenu">
                            <div id="page">
                                <div class="mobile_menu">
                                    <a href="#menu"><span></span></a>
                                    <nav id="menu">
                                        <ul>
                                            <li>
                                                <router-link :to="{name:'home'}">Home </router-link>
                                            </li>

                                            <li v-for="category in categories" :key="category.id">
                                                <router-link :to="{name:'category', params: {slug:category.slug}}">
                                                    {{category.name}}
                                                </router-link>
                                                <ul>
                                                    <li v-for="hsubcategory in category.subcategories" :key="hsubcategory.id">
                                                        <router-link :to="{name:'subcategory', params: {slug:hsubcategory.slug}}">{{hsubcategory.subcategoryName}}</router-link>
                                                        <ul>
                                                            <li v-for="childcategory in hsubcategory.childcategories" :key="childcategory.id">
                                                                <router-link :to="{name:'products',params:{slug:childcategory.slug}}">{{childcategory.childcategoryName}}</router-link>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <li><router-link :to="{name:'feeback'}">Feedback</router-link></li>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu End -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mobile-search main-search" v-show="searchShow">
                                <form>
                                    <input type="text" name="keyword" v-on:keyup="search()" v-model="keyword" class="search_data" placeholder="Search here..." />
                                    <button type="submit" @click.stop.prevent="submit()"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-sm-none main-menu-mobile">
                <ul>
                    <li><router-link :to="{name:'home'}">Home</router-link></li>
                    <li><router-link :to="{name:'offer'}">Offer</router-link></li>
                    <li><router-link :to="{name:'trackform'}">Track Order</router-link></li>
                    <li><router-link :to="{name:'coupon'}">Coupons</router-link></li>
                    
                </ul>
            </div>
            <!-- Mobile header top End -->
        </header>
        <!--main header area end-->
         <section class="mlogo-cart">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="m-menu">
                            <router-link :to="{name:'showcart'}">
                                <p><i class="fa fa-shopping-bag"></i></p>
                                <p>Cart <span>{{cartItemCount}}</span></p>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="m-menu m-wishlist">
                            <router-link :to="{name:'wishlist'}">
                                <p><i class="fa fa-heart"></i></p>
                                <p>Wishlist <span>{{wishlistCount}}</span></p>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="m-menu">
                            <router-link :to="{name:'compare'}">
                                <p><i class="fa fa-random"></i></p>
                                <p>Compare <span>{{compareCount}}</span></p>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="m-menu">
                            <div v-if="isLoggedIn">
                                <router-link :to="{name:'customeraccount'}">
                                    <p><i class="fa fa-user"></i></p>
                                    <p>Account</p>
                                </router-link>
                            </div>
                            <div v-else>
                                <router-link :to="{name:'login'}">
                                    <p><i class="fa fa-user"></i></p>
                                    <p>Sign In</p>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="header-gap"></div>
        <router-view></router-view>
        <footer class="desktop_footer" >
            <div class="footer-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <div class="footer-widget">
                                <h3>contact us</h3>
                                <ul class="footer-contact nospace" v-for="(value,index) in contact">
                                    <li>
                                        <p>{{value.address}}</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        <a href="">{{value.email}}</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        <a href="">{{value.phone}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer-widget start -->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <div class="footer-widget">
                                <h3>Customer Service</h3>
                                <ul class="footer-link">
                                    <li v-for="(value,index) in footermenuleft">
                                        <router-link :to="{name : 'morepage',params:{slug:value.slug}}">{{value.pagename}}</router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer-widget start -->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <div class="footer-widget">
                                <h3>More Links</h3>
                                <ul class="footer-link">
                                    <li v-for="(value,index) in footermenuright"><router-link :to="{name : 'morepage',params:{slug:value.slug}}">{{value.pagename}}</router-link></li>
                                    
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="footer-widget">
                                <h3>Connect With Us</h3>
                                <div class="widget">
                                    <div class="social my-3 d-block">
                                        <a :href="value.link" v-for="(value,index) in socialicons" target="_blank" :class="value.name"><i :class="value.icon"></i></a>
                                    </div>
                                    <p class="widget-p">What We Accept</p>

                                    <div class="payment-accept d-block">
                                        <img src="public/frontEnd/images/payment.webp" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- footer-widget end -->
                    </div>
                </div>
            </div>
        </footer>
        <!--footer end-->
        <section class="mobile-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="container-fluid my-4">
                        <!--Accordion wrapper-->
                        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                            <!-- Accordion card -->
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header custmon-card-head" role="tab" id="headingOne1">
                                    <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                        <h5 class="mb-0 collaps-title">Contact <i class="fa fa-angle-down rotate-icon"></i></h5>
                                    </a>
                                </div>
                                <!-- Card body -->
                                <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                                    <div class="card-body">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="footer-widget collapse-content">
                                                <ul class="footer-contact nospace" v-for="(value,index) in contact">
                                                    <li>
                                                        <p>{{value.address}}</p>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-envelope"></i>
                                                        <a href="">{{value.email}}</a>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-phone"></i>
                                                        <a href="">{{value.phone}}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card End -->

                            <div class="card">
                                <div class="card-header custmon-card-head" role="tab" id="headingTwo2">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                        <h5 class="mb-0 collaps-title">Customer Service <i class="fa fa-angle-down rotate-icon"></i></h5>
                                    </a>
                                </div>
                                <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                                    <div class="card-body">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                            <div class="footer-widget collapse-content">
                                                <ul class="footer-contact">
                                                    <li v-for="(value,index) in footermenuleft">
                                                        <router-link :to="{name : 'morepage',params:{slug:value.slug}}">{{value.pagename}}</router-link>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header custmon-card-head" role="tab" id="headingThree3">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                        <h5 class="mb-0 collaps-title">More Link <i class="fa fa-angle-down rotate-icon"></i></h5>
                                    </a>
                                </div>

                                <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionEx">
                                    <div class="card-body">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                            <div class="footer-widget collapse-content">
                                                <ul class="footer-contact">
                                                    <li v-for="(value,index) in footermenuright"><router-link :to="{name : 'morepage',params:{slug:value.slug}}">{{value.pagename}}</router-link></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion card -->
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header custmon-card-head" role="tab" id="headingThree4">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                        <h5 class="mb-0 collaps-title">Social Media<i class="fa fa-angle-down rotate-icon"></i></h5>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapseThree4" class="collapse" role="tabpanel" aria-labelledby="headingThree4" data-parent="#accordionEx">
                                    <div class="card-body">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                            <div class="footer-widget collapse-content">
                                                <div class="widget">
                                                    <div class="footer-logo">
                                                        <router-link :to="{name:'home'}"><img :src="logo.image" alt="" /></router-link>
                                                    </div>
                                                    <p class="my-3">Follow Us</p>
                                                    <div class="social my-3 d-block">
                                                        <a href="" v-for="(value,index) in socialicons" target="_blank" :class="value.name"><i :class="value.icon"></i></a>
                                                    </div>
                                                    <div class="payment-accept d-block">
                                                        <img src="public/frontEnd/images/payment.webp" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Accordion card -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="footer-bottom-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p style="color: #fff;">Copyright © <span v-for="config in config">{{ config.sitename}}</span> All rights reserved. Developed By <a href="https://glowracksit.com/" target="_blank">Glowracks IT</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import sidebar from "../components/includes/sidebar";
    export default {
        components: {
            sidebar,
        },
        data() {
            return {
                logo: {},
                contact: [],
                footermenuleft: [],
                footermenuright: [],
                socialicons: [],
                config: [],
                keyword: null,
                categories: [],
                searchShow: false,
            };
        },
        methods: {
            loadData() {
                axios.get("/api/v1").then((response) => {
                    console.log("app");
                });

                axios.get("/api/v1/logo").then((response) => {
                    this.logo = response.data.logo;
                });
                axios.get("/api/v1/all-category").then((response) => {
                    this.categories = response.data.categories;
                });
                axios.get("/api/v1/contact-us").then((response) => {
                    this.contact = response.data.contact;
                    this.socialicons = response.data.socialicons;
                });
                axios.get("/api/v1/about-company").then((response) => {
                    this.footermenuleft = response.data.footermenuleft;
                    this.footermenuright = response.data.footermenuright;
                });
                axios.get("/api/v1/config").then((response) => {
                    this.config = response.data.config;
                });
            },
            logout() {
                axios.post("/api/v1/customer/logout?token=" + localStorage.getItem("token")).then((response) => {
                    if (response.data.status == "success") {
                        this.$toast.success({
                            title: "Success!",
                            message: "You are logged in successfully.",
                        });
                        localStorage.removeItem("token");
                        this.$store.dispatch("Logout");
                        this.$router.push({ name: "login" });
                    } else {
                        this.$toast.error({
                            title: "Opps!",
                            message: "Your token does not match.",
                        });
                    }
                });
            },
            search() {
                console.log(this.keyword);
                this.$router.push({ name: "search", params: { keyword: this.keyword } });
            },
        },
        computed: {
            cart() {
                return this.$store.state.cart;
            },
            cartItemCount() {
                return this.$store.getters.cartItemCount;
            },
            cartTotalPrice() {
                return this.$store.getters.cartTotalPrice;
            },
            wishlist() {
                return this.$store.state.wishlist;
            },
            wishlistCount() {
                return this.$store.getters.wishlistCount;
            },
            compare() {
                return this.$store.state.compare;
            },
            compareCount() {
                return this.$store.getters.compareCount;
            },
            isLoggedIn() {
                return this.$store.state.token;
            },
        },
        mounted() {
            this.$store.dispatch("getCartitems");
            this.$store.dispatch("getWishitems");
            this.$store.dispatch("getCompareitems");
            this.$store.dispatch("isLoggedIn");
            this.loadData();
        },
    };
</script>
