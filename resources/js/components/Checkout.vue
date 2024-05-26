<template>
    <div>
        <section class="productarea section-padding">
            <div class="container">
                <form @submit.prevent="checkout">
                    <div class="row light_bg">
                        <div class="col-sm-7">
                            <div class="checkout-card card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn">Shipping Address</button>
                                    </h2>
                                </div>

                                <div class="card-body row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fullName">Full Name *</label>
                                            <input type="text" class="form-control" placeholder="Your Name*" name="fullName" v-model="checkoutForm.fullName=customer.fullName" id="fullName" />
                                            <div v-if="checkoutForm.errors.has('fullName')" v-html="checkoutForm.errors.get('fullName')" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phoneNumber">Phone Number *</label>
                                            <input type="text" class="form-control" placeholder="Your phone Number*" v-model="checkoutForm.phoneNumber=customer.phoneNumber" name="phoneNumber" id="phoneNumber" />
                                            <div v-if="checkoutForm.errors.has('phoneNumber')" v-html="checkoutForm.errors.get('phoneNumber')" />
                                        </div>
                                    </div>
                                    <!-- phone number ends --> 
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="district">District *</label>
                                            <select class="form-control district" name="district" id="district" @change="selectdist()" v-model="checkoutForm.district">
                                                <option value="">Select District</option>
                                                <option v-for="(district,index) in districts" :value="district.id">{{district.name}}</option>
                                            </select>
                                            <div v-if="checkoutForm.errors.has('district')" v-html="checkoutForm.errors.get('district')" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="area">Area *</label>
                                            <select class="form-control" @change="selectarea()" v-model="checkoutForm.area" name="area" id="area">
                                                <option value="">Select Area</option>
                                                <option v-for="area in areas" :key="area.id" :value="area.id">{{area.area}}</option>
                                            </select>
                                            <div v-if="checkoutForm.errors.has('area')" v-html="checkoutForm.errors.get('area')" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address">Full Address *</label>
                                            <textarea type="text" class="form-control" name="address" v-model="checkoutForm.address" id="address" placeholder="Your Address*"></textarea>
                                            <div v-if="checkoutForm.errors.has('address')" v-html="checkoutForm.errors.get('address')" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="note">Note (optional)</label>
                                            <textarea type="text" v-model="checkoutForm.note" class="form-control" name="note" id="note" placeholder="Note"></textarea>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                        </div>
                        <!-- col-7 end -->
                        <div class="col-sm-5">
                            <div class="cart-checkout">
                                <div class="cart-heading">
                                    <h3>Cart totals</h3>
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
                                            <p class="text-monospace text-right">TK {{cartTotalPrice}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <p>Discount (-)</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-right text-success">TK <span v-if="discount !=null">{{ discount }}</span><span v-else></span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <p>Delivery Charge (+)</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-right text-success">TK {{shippingfee}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <p>Total</p>
                                        </div>
                                        <div class="col-5">
                                            <h5 class="text-right">TK {{ Number(cartTotalPrice) + Number(shippingfee) - discount }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div id="" class="" aria-labelledby="" data-parent="#">
                                    <div class="card-body">
                                        <div class="set-shipping">
                                            <div class="select-payment-option">
                                                <input type="hidden" />
                                                <div class="form-group paymentItem">
                                                    <label for="cod" class="cbutton"> 
                                                        <input type="radio" id="cod" value="cod" class="paymentoption" v-model="checkoutForm.paymentType" name="paymentType" />
                                                        Cash On Delivery 
                                                    </label>

                                                    <div class="codform">
                                                        <div class="form-group">
                                                            <p>Inside Dhaka Full Cash On Delivery . If your address is outside Dhaka, you only need to bKash the delivery charge of amount in advance.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group paymentItem">
                                                    <label for="bkash" class="bbutton">
                                                        <input type="radio" id="bkash" value="bkash" class="paymentoption" name="paymentType" v-model="checkoutForm.paymentType" /> 
                                                        Bkash
                                                        <img src="public/frontEnd/images/pbkash.png" />
                                                    </label>
                                                    <div class="bkashform">
                                                        <p>Follow these steps for bKash payment</p>
                                                        <p>01. Go to your bKash Mobile Menu by dialing *247#</p>
                                                        <p>02. Choose “Send Money”</p>
                                                        <p>03. Enter The bKash Account Number 01970597767</p>
                                                        <p>04. Enter Your amount</p>
                                                        <p>05. Enter a reference 1234</p>
                                                        <p>07. Now enter your bKash Mobile Menu PIN to confirm</p>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="bsenderId" value="" placeholder="Enter Mobile Number" v-model="checkoutForm.bsenderId" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="btransectionId" value="" placeholder="Enter Transection ID" v-model="checkoutForm.btransectionId" />
                                                        </div>
                                                    </div>
                                                    <!--bkashform end-->
                                                </div>

                                                <div class="form-group paymentItem">
                                                    <label for="roket" class="rbutton">
                                                        <input type="radio" id="roket" value="roket" class="paymentoption" name="paymentType" v-model="checkoutForm.paymentType" /> Roket
                                                        <img src="public/frontEnd/images/procket.png" alt="" style="width: 50px;" />
                                                    </label>
                                                    <div class="roketform">
                                                        <p>Follow these steps for Rocket payment</p>
                                                        <p>01. Go to your Rocket mobile menu by dialing *322#</p>
                                                        <p>02. Choose “Send Money”</p>
                                                        <p>03. Enter The Roket Account Number 017XXXXXXXX2</p>
                                                        <p>04. Enter Your amount</p>
                                                        <p>05. Enter a reference 1234</p>
                                                        <p>07. Now enter your roket mobile menu PIN to confirm</p>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="rsenderId" value="" placeholder="Enter Mobile Number" v-model="checkoutForm.rsenderId" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="rtransectionId" value="" placeholder="Enter Transection ID" v-model="checkoutForm.rtransectionId" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group paymentItem">
                                                    <label for="nagad" class="nbutton">
                                                        <input type="radio" id="nagad" value="nagad" class="paymentoption" name="paymentType" v-model="checkoutForm.paymentType" /> Nagad
                                                        <img src="public/frontEnd/images/pnagad.png" alt="" />
                                                    </label>
                                                    <!--nagadform end-->
                                                    <div class="nagadform">
                                                        <p>Follow these steps for Nagad payment</p>
                                                        <p>01. Go to your Nagad Mobile Menu by dialing *167#</p>
                                                        <p>02. Choose “Send Money”</p>
                                                        <p>03. Enter The Nagad Account Number 017XXXXXXXX</p>
                                                        <p>04. Enter Your amount</p>
                                                        <p>05. Enter a reference 1234</p>
                                                        <p>07. Now enter your Nagad Mobile Menu PIN to confirm</p>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="nsenderId" value="" placeholder="Enter Mobile Number" v-model="checkoutForm.nsenderId" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="ntransectionId" value="" placeholder="Enter Transection ID" v-model="checkoutForm.ntransectionId" />
                                                        </div>
                                                    </div>
                                                    <!--nagadform end-->
                                                </div>

                                                <div class="dsfsad">
                                                    <div class="pcondition">
                                                        <label for="terms" class="" style="text-align: left;"> <input type="checkbox" id="terms" class="paymentoption" name="terms" /> I have read and agree to the website terms and conditions * </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Confirm Order</button>
                                                    </div>
                                                    <div class="ptext">
                                                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="shipping-order-info ShippingCart"></div> -->
                                        </div>
                                        <!--login content end-->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--row end-->
                    </div>
                </form>
            </div>
        </section>
        <!--productarea end-->
    </div>
</template>

<script>
    import Form from "vform";
    import $ from 'jquery'
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
            customer: {},
            areas: [],
            shippingfee: localStorage.getItem("shippingfee") ? localStorage.getItem("shippingfee") : 0,
            discount: localStorage.getItem("discount") ? localStorage.getItem("discount") : 0,
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
                    console.log(this.areas);
                });
            },
            // areas() {
            //     axios.get("/api/v1/areas").then((response) => {
            //         this.areas = response.data.areas;
            //     });
            // },
            selectarea() {
                axios.get("/api/v1/shippingfee/" + this.checkoutForm.area).then((response) => {
                    this.shippingfee = response.data.shippingfee.shippingfee;
                    localStorage.setItem("shippingfee", response.data.shippingfee.shippingfee);
                });
            },
            async checkout() {
                if (this.$store.state.token) {
                    const response = await this.checkoutForm
                        .post("/api/v1/customer/order/save", {
                            headers: {
                                Authorization: "Bearer " + localStorage.getItem("token"),
                                shippingfee: localStorage.getItem("shippingfee") ? localStorage.getItem("discount") : 0,
                                discount: localStorage.getItem("discount") ? localStorage.getItem("discount") : 0,
                            },
                        })
                        .then((response) => {
                            if (response.data.status == "success") {
                                this.$toast.success({
                                    title: "Success!",
                                    message: "Your order place successfully.",
                                });
                                localStorage.removeItem("shippingfee");
                                localStorage.removeItem("discount");
                                localStorage.removeItem("couponcode");
                                this.$store.dispatch("getCartitems");
                                this.$router.push({ name: "myorder" });
                            } else {
                                this.$toast.error({
                                    title: "Opps!",
                                    message: "Order place failed",
                                });
                            }
                        });
                } else {
                    this.$router.push({ name: "login" });
                }
            },
            loadScript(){
                  $('.codform').hide();
                  $('.bkashform').hide();
                  $('.nagadform').hide();
                  $('.roketform').hide();

                $('.paymentoption').on('click', function() {
                  var id = $(this).val();
                  var area = $('.area').val();
                  // alert(area);
                    if(id,area){
                        $.ajax({
                           type:"GET",
                           url:"http://www.sparklefashionbd.com/payment-charge/"+id+"/"+area,
                           dataType: "html",
                            success: function(response){
                                $('.paymentCharge').html(response);
                            }
                        });
                    }
                    if(id=="cod"){
                      $('.codform').show();
                      $('.bkashform').hide();
                      $('.nagadform').hide();
                      $('.roketform').hide();
                    }
                    else if(id=='bkash'){
                      $('.codform').hide();
                      $('.roketform').hide();
                      $('.nagadform').hide();
                      $('.bkashform').show();
                    }
                    else if(id=='roket'){
                      $('.codform').hide();
                      $('.bkashform').hide();
                      $('.nagadform').hide();
                      $('.roketform').show();
                    }
                    else if(id=='nagad'){
                      $('.codform').hide();
                      $('.bkashform').hide();
                      $('.roketform').hide();
                      $('.nagadform').show();
                    }
                    else if(id==''){
                      $('.codform').show();
                      $('.bkashform').hide();
                      $('.nagadform').hide();
                      $('.roketform').hide();
                    }
                });
                $('.cbutton').on('click', function() {
                   $(this).addClass('active');
                   $('.bbutton').removeClass('active');
                   $('.rbutton').removeClass('active');
                   $('.nbutton').removeClass('active');
                   
                });
                $('.bbutton').on('click', function() {
                   $(this).addClass('active');
                   $('.cbutton').removeClass('active');
                   $('.rbutton').removeClass('active');
                   $('.nbutton').removeClass('active');
                });
                $('.rbutton').on('click', function() {
                   $(this).addClass('active');
                   $('.cbutton').removeClass('active');
                   $('.bbutton').removeClass('active');
                   $('.nbutton').removeClass('active');
                });
                $('.nbutton').on('click', function() {
                   $(this).addClass('active');
                   $('.cbutton').removeClass('active');
                   $('.bbutton').removeClass('active');
                   $('.rbutton').removeClass('active');
                });
            }
        },
        mounted() {
            this.districts();
            // this.areas();
            this.loadData();
            this.loadScript();
        },
        components: {
            sidebar,
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
    };
</script>
