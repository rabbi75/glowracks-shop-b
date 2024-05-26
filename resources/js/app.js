import Vue from 'vue'
window.axios = require('axios');
import VueRouter from 'vue-router'
Vue.use(VueRouter)


import App from './components/App.vue'
import Home from './components/Home.vue'
import Category from './components/Category.vue'
import Subcategory from './components/Subcategory.vue'
import Childcategory from './components/Childcategory.vue'
import Offer from './components/Offer.vue'
import Productdetails from './components/Productdetails.vue'
import Cart from './components/Cart.vue'
import Checkout from './components/Checkout.vue'
import Wishlist from './components/Wishlist.vue'
import Compare from './components/Compare.vue'
import Combo from './components/Combo.vue'
import Coupon from './components/Coupon.vue'
import Blogcategory from './components/Blogcategory.vue'
import Blog from './components/Blog.vue'
import Blogdetails from './components/Blogdetails.vue'
import Trackform from './components/Trackform.vue'
import trackResult from './components/trackResult.vue'
import morePage from './components/morePage.vue'
import searchPage from './components/searchPage.vue'
import Achievement from './components/Achievement.vue'
import Companyinfo from './components/Companyinfo.vue'
import Feedback from './components/Feedback.vue'
import Gallery from './components/Gallery.vue'

// customer route
import Register from './components/customer/Register.vue'
import Login from './components/customer/Login.vue'
import Accountverify from './components/customer/Accountverify.vue'

import Forgetpassword from './components/customer/Forgetpassword.vue'
import Forgetpassverify from './components/customer/Forgetpassverify.vue'
import Account from './components/customer/Account.vue'
import Changepassword from './components/customer/Changepassword.vue'
import Editprofile from './components/customer/Editprofile.vue'
import Myorder from './components/customer/Myorder.vue'
import Invoice from './components/customer/Invoice.vue'
import OrderDetails from './components/customer/OrderDetails.vue'
let localtoken = window.localStorage.getItem('token');

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                title: 'Home'
            }
        },
        {
            path: '/category/:slug',
            name: 'category',
            component: Category,
            props: true,
            meta: {
                title: 'Category'
            }
        },
        {
            path: '/subcategory/:slug',
            name: 'subcategory',
            component: Subcategory,

        },
        {
            path: '/products/:slug',
            name: 'products',
            component: Childcategory,

        },
        {
            path: '/offer',
            name: 'offer',
            component: Offer,
            meta: {title: 'Offer'}
        },
        {
            path: '/product-details/:id/:slug',
            name: 'productdetails',
            component: Productdetails,
            meta: {title: 'Product details'}

        },
        {
            path: '/cart',
            name: 'showcart',
            component: Cart,
            meta: {title: 'Cart'},
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout,
            meta: {title: 'Checkout',auth:true},
        },
        {
            path: '/wishlist',
            name: 'wishlist',
            component: Wishlist,
            meta: {title: 'Wishlist'}
        },
        {
            path: '/compare',
            name: 'compare',
            component: Compare,
            meta: {title: 'Compare'}
        },
        {
            path: '/combo',
            name: 'combo',
            component: Combo,
            meta: {title: 'Combo Offer'}
        },
        {
            path: '/coupon',
            name: 'coupon',
            component: Coupon,
            meta: {title: 'Coupon'}
        },
        {
            path: '/blogcategory/:slug',
            name: 'blogcategory',
            component: Blogcategory,
            meta:{title: 'Blog Category'}
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog,
            meta: {title: 'Blog'}
        },
        {
            path: '/blog/details/:id/:slug',
            name: 'blogdetails',
            component: Blogdetails,
            meta: {title: 'Blog Details'}
        },
        {
            path: '/track-order',
            name: 'trackform',
            component: Trackform,
            meta: {title: 'Track Form'}
        },
        {
            path: '/track/order/result/:id',
            name: 'trackresult',
            component: trackResult,
            meta: {title: 'Track Order'}
        },
        {
            path: '/more/:slug',
            name: 'morepage',
            component: morePage,
            meta: {title: 'More Info'}
        },
        {
            path: '/achievement',
            name: 'achievement',
            component: Achievement,
            meta: {title: 'Achievement'}
        },
        {
            path: '/companyinfo',
            name: 'companyinfo',
            component: Companyinfo,
            meta: {title: 'Company Info'}
        },
        {
            path: '/search/:keyword',
            name: 'search',
            component: searchPage,
            meta: {title: 'Search'},
        },
        {
            path: '/client-feeback/',
            name: 'feeback',
            component: Feedback,
            meta: {title: 'Client Feeback'},
        },{
            path: '/gallery/',
            name: 'gallery',
            component: Gallery,
            meta: {title: 'Gallery'},
        },
        {
            path: '/customer/register',
            name: 'register',
            component: Register,
            meta: {title: 'Register'}
        },
        {
            path: '/customer/login',
            name: 'login',
            component: Login,
            meta: {title: 'Login'}
        },
        {
            path: '/customer/verify',
            name: 'accountverify',
            component: Accountverify,
            meta: {
                title: 'Verify'
            }
        },
        {
            path: '/customer/forget-password',
            name: 'forgetpassword',
            component: Forgetpassword,
            meta: {title: 'Forget Password'}
        },
        {
            path: '/customer/forget-verify',
            name: 'forgetpassverify',
            component: Forgetpassverify,
            meta: {title: 'Forget Verify'}
        },
        {
            path: '/customer/account',
            name: 'customeraccount',
            component: Account,
            meta: {title: 'My Account',auth:true},
        },
        {
            path: '/customer/profile/edit',
            name: 'editprofile',
            component: Editprofile,
            meta: {title: 'Edit Profile',auth:true},
        },
        {
            path: '/customer/order',
            name: 'myorder',
            component: Myorder,
            meta: {title: 'My Order',auth:true},
        },
        {
            path: '/customer/order/invoice/:id',
            name: 'orderinvoice',
            component: Invoice,
            meta: {title: 'Invoice',auth:true},
        },
        {
            path: '/customer/order/details/:id',
            name: 'orderdetails',
            component: OrderDetails,
            meta: {title: 'Order Details',auth:true},
        },
        {
            path: '/customer/change/password/',
            name: 'changepassword',
            component: Changepassword,
            meta: {title: 'Change Password',auth:true},
        },
    ],
    scrollBehavior (to, from, savedPosition) {
      return { x: 0, y: 0 };
    }
});
import beforeEach from './beforeEach'

// axios.defaults.baseURL = 'https://localhost/mirrorbd/';
axios.defaults.baseURL = 'https://glowracksit.com/mirrorbd/';
// intial customer detect
if(localStorage.getItem('customer_id') === null){
    let uniqueId = Date.now().toString(36) + Math.random().toString(36).substring(2);
    localStorage.setItem('customer_id',uniqueId);
    axios.defaults.headers.common['customer_id'] = uniqueId;
}else{
     axios.defaults.headers.common['customer_id'] = localStorage.getItem('customer_id');
}

import carousel from 'vue-owl-carousel'

import CxltToastr from 'cxlt-vue2-toastr'
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css'
var toastrConfigs = {
    position: 'top right',
    showDuration: 500,
    timeOut: 3000,
    showMethod: "fadeInRight",
    hideMethod: "fadeOutRight",
    progressbar: false,
     clickClose: false
}
Vue.use(CxltToastr, toastrConfigs)

import VuexPersistence from 'vuex-persist'
import Vuex from 'vuex'
Vue.use(Vuex)
import store from "./store";
Vue.component('pagination', require('laravel-vue-pagination'));
import Form from 'vform'
import VueNestedMenu from 'vue-nested-menu';
Vue.use(VueNestedMenu);
router.beforeEach(beforeEach)
import $ from 'jquery'
const app = new Vue({
    el: '#app',
    router,
    store,
    components: { App},
});
 router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title}`;
    $('.mm-ocd').removeClass('mm-ocd--open');
    $('body').removeClass('modal-open');
    $('body').css('padding', '0');
    $('.modal-backdrop').removeClass('show');
    $('.modal-backdrop').removeClass('fade');
    $('.modal-backdrop').removeClass('modal-backdrop');
    next();
})
const vuexLocal = new VuexPersistence({
  storage: window.localStorage
});






