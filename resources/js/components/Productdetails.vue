<template>
    <div>
        <!--common html-->
        <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                            <sidebar></sidebar>
                            <li><i class="fa fa-home"></i> <router-link :to="{name : 'home'}"> Home </router-link></li>
                            <li><a class="anchor">/</a></li>
                            <li>
                                <router-link :to="{name: 'category', params: { 'slug' : details.category.slug}}">
                                    {{details.category.name}}
                                </router-link>
                            </li>
                            <li><a class="anchor">/</a></li>
                            <li><a>{{details.proName}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-details section-padding">
            <div class="container">
                <div class="row light_bg-pdetails">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="productdetails-slider">
                            <div class="card-carousel">
                                <div class="dslider-big">
                                    <pic-zoom :url="currentImage" :scale="3"></pic-zoom>
                                    <div class="actions">
                                        <span @click="prevImage" class="prev">
                                            <i class="fa fa-chevron-left"></i>
                                        </span>
                                        <span @click="nextImage" class="next">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="dslider-thumb">
                                    <div v-for="(image, index) in  images" :key="image.id" :class="['thumbnail-image', (activeImage == index) ? 'active' : '']" @click="activateImage(index)">
                                        <img :src="image.image" />
                                    </div>
                                </div>
                            </div>
                            <!-- Swiper -->
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="productdetails-info">
                            <span class="category-name">{{details.category.name}}</span>
                            <p class="dproduct-name">{{details.proName}}</p>
                            <div class="pro-highlight">
                                <div class="pro-highlight-left">
                                    <div class="review">
                                        <ul>
                                            <li>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span>{{review.length}} Review(s)</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <p><strong>SKU: </strong>{{details.id}}</p>
                                    <p v-if="details.unit"><strong>Unit: </strong>{{details.unit}}</p>
                                </div>
                                <div class="pro-highlight-right">
                                    <p><strong>Availability: </strong><span v-if="details.proQuantity > 0"> In Stock</span> <span v-else> Out Of Stock</span></p>
                                    
                                </div>
                            </div>
                            <div class="details-pro-price">
                                <span>৳ {{details.proNewprice}}</span>

                                <del>৳ {{details.proOldprice}}</del>
                            </div>
                            <div class="details-quantity-area">
                                <form @submit.prevent="addtocart" class="dbform form-row">
                                    <input type="hidden" name="product_id" :value="productForm.product_id=details.id" />
                                    <div class="quantity-part col-sm-6">
                                        <div class="from-group">
                                            <div class="quantity-part-input">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <a v-bind:disabled="quantity < 1" id="quantity-left" v-on:click="decrement">
                                                            <i class="fa fa-minus"></i>
                                                        </a>
                                                    </span>
                                                    <input name="qty" class="input-number" v-model="productForm.quantity=quantity" min="1" />
                                                    <span class="input-group-btn">
                                                        <a v-on:click="increment" id="quantity-right">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details-cart-part col-sm-6 d-none" if="details.proQuantity > 0">
                                        <!-- Product Color -->
                                        <div class="size-select" v-if="sizes.length > 0">
                                            <select id="product_size" name="product_size" class="form-control" v-model="productForm.product_size">
                                                <option value="">Select Size</option>
                                                <option v-for="(size,index) in sizes" v-model="size.size.sizeName"> {{size.size.sizeName}}</option>
                                            </select>
                                        </div>
                                        <div class="color-select" v-if="colors.length > 0">
                                            <select id="product_color" name="product_color" class="form-control" v-model="productForm.product_color">
                                                <option value="">Select Color</option>
                                                <option v-for="(color,index) in colors" v-model="color.color.colorName">{{color.color.colorName}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="details-cart-part col-sm-12">
                                        <div class="cart-button-box" v-if="details.proQuantity > 0">
                                            <button class="dbutton addcart">Add To Bag</button>
                                            <button class="dbutton buynow">Buy Now</button>
                                            
                                        </div>
                                        <p class="btn btn-primary" v-else>Stock Out</p>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- row end -->
                <div class="row light_bg-pdetails" style="margin-top: 10px;">
                    <div class="col-md-12 col-sm-12">
                        <div class="details-tab-area">
                            <ul class="nav nav-tabs details_tab" id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#proDres" role="tab" aria-controls="proDres" aria-selected="true">Product Description</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#proReview" role="tab" aria-controls="proReview" aria-selected="false">Review</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#questions" role="tab" aria-controls="questions" aria-selected="false">Ask Questions</a>
                                </li>
                                
                            </ul>
                            <div class="tab-content pdetails-description" id="myTabContent">
                                <div class="tab-pane fade show active" id="proDres" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="details">
                                        <div v-html="details.proDescription">{{ details.proDescription }}</div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="size-img-box chart-image">                          
                                                    <p>Size Charts:</p>
                                                    <img :src="details.subcategory.size" alt="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="measure-img-box chart-image">                           
                                                    <p>How to Measure:</p>
                                                    <img :src="details.subcategory.measure" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="proReview" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="review-section">
                                        <div class="reiveiw-title">
                                            <h5>Product ({{reviews.length}}) Reviews</h5>
                                        </div>
                                        <div class="person-review" v-if="reviews.length > 0">
                                            <div class="review" v-for="(review, index) in reviews">
                                                <ul>
                                                    <li v-if="review.ratting == 1 ">
                                                        <i class="fa fa-star"></i>
                                                    </li>
                                                    <li v-if="review.ratting >=2 && review.ratting < 1">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </li>
                                                    <li v-if="review.ratting >=3 && review.ratting < 2 ">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </li>
                                                    <li v-if="review.ratting >=4 && review.ratting < 3 ">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </li>
                                                    <li v-if="review.ratting >=5 ">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </li>
                                                </ul>
                                                <h4>By {{review.rcustomer.fullName}}</h4>
                                                <p>{{review.review}}</p>
                                                <img :src="review.image" />
                                            </div>
                                        </div>
                                        <!-- single review -->

                                        <div class="get-review" v-if="isLoggedIn">
                                            <div class="login-btn">
                                                <p>Write here your review</p>
                                            </div>
                                            <form @submit.prevent="review" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" v-model="reviewForm.product_id=details.id" />
                                                <div class="form-group">
                                                    <label for="ratting">Select Ratting</label>
                                                    <AwesomeVueStarRating
                                                        :star="this.star"
                                                        v-model="reviewForm.ratting=this.star"
                                                        :disabled="this.disabled"
                                                        :maxstars="this.maxstars"
                                                        :starsize="this.starsize"
                                                        :hasresults="this.hasresults"
                                                        :hasdescription="this.hasdescription"
                                                        :ratingdescription="this.ratingdescription"
                                                    />
                                                </div>
                                                <div class="form-group">
                                                    <label for="review">Your Review Message</label>
                                                    <textarea class="form-control" v-model="reviewForm.review" name="review" id="" rows="5"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" accept="*" class="form-control" v-on:change="onChange" name="image" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" value="submit review" class="btn btn-success" />
                                                </div>
                                            </form>
                                        </div>
                                        <div class="get-review" v-else>
                                            <div class="login-btn">
                                                <p>
                                                    <router-link :to="{name:'login'}"><u>Login</u></router-link> for submit review
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="review-section product-comments-area" id="commentsec">
                                        <div class="reiveiw-title">
                                            <h5>Questions about this product ({{comments.length}})</h5>
                                        </div>
                                        <div class="product-comments" v-if="comments.length > 0">
                                            <div class="question-item" v-for="(comment, index) in comments">
                                                <div class="question">
                                                    <strong>Q</strong><span style="font-weight: 600;"> {{comment.comment}}</span>
                                                    <p style="font-weight: normal;">
                                                        <span>{{comment.created_by}}</span>
                                                    </p>
                                                </div>
                                                <div class="answer">
                                                    <strong>Ans: <span> {{ comment.answer }}</span></strong>
                                                    <p style="font-weight: normal;">
                                                        -
                                                        <span></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <form @submit.prevent="newcomment" class="commentform" v-if="isLoggedIn">
                                            <input type="hidden" name="product_id" v-model="commentForm.product_id=details.id" />
                                            <div class="form-group">
                                                <label>Your comments</label>
                                                <textarea cols="8" class="from-control" v-model="commentForm.comment" name="comment"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit">Submit</button>
                                            </div>
                                        </form>
                                        <div class="review-section product-comments-area" id="commentsec" v-else>
                                            <div class="login-btn">
                                                <p>
                                                    <router-link :to="{name:'login'}"><u>Login</u></router-link> for submit aks questions
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import PicZoom from "vue-piczoom";
    import Form from "vform";
    import sidebar from "../components/includes/sidebar";
    import { AddToCart } from "../mixin";
    import carousel from "vue-owl-carousel";
    import AwesomeVueStarRating from "awesome-vue-star-rating";
    export default {
        components: {
            sidebar,
            carousel,
            AwesomeVueStarRating,
            PicZoom,
        },
        data: () => ({
            productForm: new Form({
                quantity: "",
                product_id: "",
                product_color: "",
                product_size: "",
            }),
            reviewForm: new Form({
                product_id: "",
                ratting: "",
                review: "",
                image: "",
            }),
            commentForm: new Form({
                product_id: "",
                comment: "",
            }),
            details: {},
            quantity: 1,
            reviews: {},
            comments: {},
            colors: [],
            sizes: [],
            category: [],
            images:[],
            activeImage: 0,
            star: 5, // default star
            ratingdescription: [
                {
                    text: "Poor",
                    class: "star-poor",
                },
                {
                    text: "Below Average",
                    class: "star-belowAverage",
                },
                {
                    text: "Average",
                    class: "star-average",
                },
                {
                    text: "Good",
                    class: "star-good",
                },
                {
                    text: "Excellent",
                    class: "star-excellent",
                },
            ],
            hasresults: true,
            hasdescription: true,
            starsize: "lg", //[xs,lg,1x,2x,3x,4x,5x,6x,7x,8x,9x,10x],
            maxstars: 5,
            disabled: false,
        }),
        increment() {
            this.quantity++;
        },
        decrement() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        },
        methods: {
            onChange(e) {
                this.image = e.target.files[0];
            },
            increment() {
                this.quantity++;
            },
            decrement() {
                if (this.quantity > 1) {
                    this.quantity--;
                }
            },
            loadProducts() {
                let id = this.$route.params.id;
                let slug = this.$route.params.slug;
                axios.get("/api/v1/product-details/" + id + "/" + slug).then((response) => {
                    this.details = response.data.productdetails;
                    this.images = response.data.images;
                    this.category = response.data.category;
                });
                axios.get("/api/v1/product-reviews/" + id).then((response) => {
                    this.reviews = response.data.reviews;
                });
                axios.get("/api/v1/product-comments/" + id).then((response) => {
                    this.comments = response.data.comments;
                });
                axios.get("/api/v1/product-colors/" + id).then((response) => {
                    this.colors = response.data.colors;
                });
                axios.get("/api/v1/product-sizes/" + id).then((response) => {
                    this.sizes = response.data.sizes;
                });
            },
            async addtocart() {
                const response = await this.productForm.post("/api/v1/add-to-cart").then((response) => {
                    if (response.data.status == "success") {
                        this.$store.dispatch("getCartitems");
                        this.$toast.success({
                            title: "Success!",
                            message: "Add to cart successfully.",
                        });
                    } else {
                        this.$toast.error({
                            title: "Opps!",
                            message: "Not added something wrong.",
                        });
                    }
                });
            },
            async review() {
                const response = await this.reviewForm
                    .post("/api/v1/customer/product/review", {
                        headers: {
                            Authorization: "Bearer " + localStorage.getItem("token"),
                        },
                    })
                    .then((response) => {
                        if (response.data.status == "success") {
                            this.reviews.push(response.data.review);
                            this.$toast.success({
                                title: "Success!",
                                message: "Review comment successfully",
                            });
                            this.reviewForm.reset();
                        } else {
                            this.$toast.error({
                                title: "Opps!",
                                message: "Not added something wrong.",
                            });
                        }
                    });
            },
            async newcomment() {
                const response = await this.commentForm
                    .post("/api/v1/customer/product/comment", {
                        headers: {
                            Authorization: "Bearer " + localStorage.getItem("token"),
                        },
                    })
                    .then((response) => {
                        if (response.data.status == "success") {
                            this.comments.push(response.data.comment);
                            this.$toast.success({
                                title: "Success!",
                                message: "Comment submit successfully",
                            });
                            this.commentForm.reset();
                        } else {
                            this.$toast.error({
                                title: "Opps!",
                                message: "Not added something wrong.",
                            });
                        }
                    });
            },
            nextImage() {
                var active = this.activeImage + 1;
                if (active >= this.images.length) {
                    active = 0;
                }
                this.activateImage(active);
            },
            prevImage() {
                var active = this.activeImage - 1;
                if (active < 0) {
                    active = this.images.length - 1;
                }
                this.activateImage(active);
            },
            activateImage(imageIndex) {
                this.activeImage = imageIndex;
            },
        },
        computed: {
            isLoggedIn() {
                return this.$store.state.token;
            },
            currentImage() {
                  return this.images[this.activeImage].image;
              }
        },
        mounted() {
            this.loadProducts();
        },
    };
</script>
