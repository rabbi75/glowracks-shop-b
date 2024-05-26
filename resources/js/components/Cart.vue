<template>
    <div>
        <section class="productarea section-padding">
            <div class="container">
                <div class="row light_bg justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="show-cart-body" v-if="cartItemCount > 0">
                            <table class="table table-bordered table-responsive-sm">
                                <thead>
                                    <tr class="thead-light thead-cart">
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Delete</th>
                                        <th scope="col" class="mcart-item-hide">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in cart" :key="item.product.id">
                                        <td>
                                            <div class="cart-img-box">
                                                <img :src="item.product.image.image" alt="" />
                                            </div>
                                        </td>
                                        <td class="pro-m-name">
                                            <div class="cart-item-name">
                                                <a class="anchor">{{item.product.proName}}</a>
                                            </div>
                                        </td>
                                        <td class="cart-quantity-td">
                                            <div class="cart-action">
                                                <div class="quantity-part">
                                                    <div class="from-group">
                                                        <div class="quantity-part-input">
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="quantity-left-minus" @click="DecrementToCart(item.product)" v-if="item.quantity >1">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                    <button type="button" class="quantity-left-minus" v-else>
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </span>
                                                                <input type="text" name="qty" id="quantity" disabled class="input-number" :value="item.quantity" />
                                                                <span class="input-group-btn">
                                                                    <button type="button" @click="IncrementToCart(item.product)" class="quantity-right-plus">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-remove-box">
                                                <button class="cart-remove-btn" @click="RemoveToCart(item.product)">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="item-price-td">
                                            <p>৳ {{item.product.proNewprice}}</p>
                                        </td>
                                        <td class="total-price-td">
                                            <p>৳ {{item.product.proNewprice*item.quantity}}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="delete-cart">
                                <button @click="emptycart">Clear Bag</button>
                            </div>
                        </div>
                        <div class="empty-cart-body" v-else>
                            <p>your bag is empty</p>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-8">
                                <form @submit.prevent="coupon" method="POST" class="coupon-form">
                                    <div class="form-group coupon-text">
                                        <input type="text" name="couponcode" v-model="couponForm.couponcode" placeholder="Apply your coupon code here" id="" />
                                        <div class="form-group coupon-submit">
                                            <button type="submit">Apply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-12 col-md-8">
                                <div class="cart-checkout">
                                    <div class="cart-heading">
                                        <h3>Bag totals</h3>
                                    </div>
                                    <div class="cart-summary">
                                        <div class="row">
                                            <div class="col-7">
                                                <p>Shopping Item</p>
                                            </div>
                                            <div class="col-5">
                                                <p class="text-monospace text-right">( {{cartItemCount}} <span v-if="cartItemCount > 1">Items</span> <span v-else>Item</span> )</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <p>Sub Total Cost</p>
                                            </div>
                                            <div class="col-5">
                                                <p class="text-right">TK {{cartTotalPrice}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <p>Discount (-)</p>
                                            </div>
                                            <div class="col-5">
                                                <p class="text-right">TK <span v-if="discount !=null">{{discount}}</span> <span v-else>0</span></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <p>Delivery Charge (+)</p>
                                            </div>
                                            <div class="col-5">
                                                <p class="text-right">TK {{shippingfee}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <p>Total</p>
                                            </div>
                                            <div class="col-5">
                                                <p class="text-right">TK {{ Number(cartTotalPrice) + Number(shippingfee) - discount }} </p>
                                            </div>
                                        </div>
                                        <div class="cart-summery-footer">
                                            <router-link :to="{name:'checkout'}">Place Order </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--row end-->
                    </div>
                    <!-- col-8 end -->
                </div>
            </div>
        </section>
        <!--productarea end-->
    </div>
</template>

<script>
    import Form from "vform";
    import sidebar from "../components/includes/sidebar";
    import { RemoveToCart, IncrementToCart, DecrementToCart } from "../mixin";
    export default {
        data: () => ({
            checkoutForm: new Form({
                paymentType: "",
                fullName: "",
                phoneNumber: "",
                district: "",
                area: "",
                address: "",
                note: "",
            }),
            couponForm: new Form({
                couponcode: "",
            }),
            areas: {},
            customer: {},
            discount: localStorage.getItem("discount"),
            shippingfee: localStorage.getItem("shippingfee"),
        }),
        methods: {
            loadData() {
                axios
                    .get("/api/v1/customer/account/", {
                        headers: {
                            Authorization: "Bearer " + localStorage.getItem("token"),
                        },
                    })
                    .then((response) => {
                        this.customer = response.data.customer;
                    });
            },
            districts() {
                axios.get("api/v1/districts").then((response) => {
                    this.districts = response.data.districts;
                });
            },
            selectdist() {
                axios.get("/api/v1/areas/" + this.checkoutForm.district).then((response) => {
                    this.areas = response.data.areas;
                });
            },
            selectarea() {
                axios.get("/api/v1/shippingfee/" + this.checkoutForm.area).then((response) => {
                    this.shippingfee = response.data.shippingfee.shippingfee;
                    localStorage.setItem("shippingfee", response.data.shippingfee.shippingfee);
                });
            },
            emptycart() {
                axios.post("/api/v1/cart-clear").then((response) => {
                    this.$store.dispatch("getCartitems");
                });
            },
            async coupon() {
                const response = await this.couponForm
                    .post("/api/v1/customer/coupon-apply", {
                        headers: {
                            cartamount: this.cartTotalPrice,
                        },
                    })
                    .then((response) => {
                        if (response.data.status == "success") {
                            console.log(response.data.status);
                            let discount = response.data.amount;
                            let couponcode = response.data.couponcode;
                            localStorage.setItem("discount", discount);
                            localStorage.setItem("couponcode", couponcode);
                            this.discount = discount;
                            this.$toast.success({
                                title: "Success!",
                                message: "Your coupon code applied",
                            });
                        } else if (response.data.status == "expaire") {
                            this.$toast.error({
                                title: "Opps!",
                                message: "Your coupon code expaire",
                            });
                        } else if (response.data.status == "lowamount") {
                            this.$toast.error({
                                title: "Opps!",
                                message: "Your purchase amount is low",
                            });
                        } else {
                            this.$toast.error({
                                title: "Opps!",
                                message: "Your coupon code is invalid",
                            });
                        }
                    });
            },
        },
        mounted() {
            this.districts();
            this.loadData();
        },
        components: {
            sidebar,
            RemoveToCart,
            IncrementToCart,
            DecrementToCart,
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
        },
        mixins: [RemoveToCart, IncrementToCart, DecrementToCart],
    };
</script>
