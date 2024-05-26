<?php
use Illuminate\Http\Request;

Route::group(['namespace' => 'Api','prefix'=>'v1','middleware' => 'api'], function(){
    // Frontend route
    Route::get('/','FrontEndController@index');
    Route::get('/home','FrontEndController@home');
    Route::get('/modal/product/{id}','FrontEndController@modalproduct');
    Route::get('/category/{slug}','FrontEndController@category');
    Route::get('/sliders','FrontEndController@sliders');
    Route::get('/brands','FrontEndController@brands');
    Route::get('/subcategory/{slug}','FrontEndController@subcategory');
    Route::get('/products/{slug}/{id}','FrontEndController@products');
    Route::get('/childcategory/colors/{slug}','FrontEndController@childcatcolors');
    Route::get('/childcategory/size/{slug}','FrontEndController@childcatsizes');
    Route::get('/offer','FrontEndController@offerproduct');
    Route::get('/contact-us','FrontEndController@contact');
    Route::get('/top-banner','FrontEndController@topbanner');
    Route::get('/home-topsell','FrontEndController@hometopsell');
    Route::get('/all-topsells','FrontEndController@alltopsells');
    Route::get('/all-newarrival','FrontEndController@allnewarrival');
    Route::get('/flash-deal-page','FrontEndController@allflashdeal');
    Route::get('/home-featured','FrontEndController@homeFeatured');
    Route::get('/home-latest','FrontEndController@homeLatest');
    Route::get('/flash-deal','FrontEndController@flashDeal');
    Route::get('/about-company','FrontEndController@aboutcompany');
    Route::get('/all-category','FrontEndController@allcategory');
    Route::get('/category-list','FrontEndController@categorylist');
    Route::get('/only-cat', 'FrontEndController@onlycategory');
    Route::get('mobile-category','FrontEndController@mobilecategory');
    Route::get('/brand/{slug}','FrontEndController@brandproduct');
    Route::get('/all-product','FrontEndController@allproduct');
    Route::get('/combo','FrontEndController@combo');
    Route::get('/product-details/{slug}','FrontEndController@details');
    Route::get('/related-product/{slug}','FrontEndController@relatedProduct');
    Route::get('/product-reviews/{id}','FrontEndController@proreview');
    Route::get('/product-comments/{id}','FrontEndController@procomment');
    Route::get('/more-info/{slug}', 'FrontEndController@moreinfo');
    Route::get('/achievement', 'FrontEndController@achievement');
    Route::get('/companyinfo', 'FrontEndController@companyinfo');
    Route::get('/blog','FrontEndController@blog');
    Route::get('/client-feedback','FrontEndController@clientfeedback');
    Route::get('/latest/blog','FrontEndController@latestblog');
    Route::get('/blog/category','FrontEndController@blogcategories');
     Route::get('/blog-category/{id}/{slug}','FrontEndController@blogcategory');
    Route::get('/blog/details/{id}/{slug}','FrontEndController@blogdetails');
    Route::post('/customer/order-track','FrontEndController@orderTrack');
    Route::get('/districts','FrontEndController@districts');
    Route::get('/areas/{district_id}','FrontEndController@areas');
    // Route::get('/areas','FrontEndController@areas');
    Route::get('/shippingfee/{area_id}','FrontEndController@shippingfee');
    Route::get('/more/{slug}','FrontEndController@morepage');
    Route::get('/search/{keyword}','FrontEndController@search');
    Route::get('/logo','FrontEndController@logo');
    Route::get('/coupon','FrontEndController@coupon');
    Route::get('/allshops','FrontEndController@allshops');
    Route::get('/shopspro/{slug}','FrontEndController@shopspro');
    Route::get('/product-reviews/{slug}','FrontEndController@proreview');
    Route::get('/product-comments/{id}','FrontEndController@procomment');
    Route::get('/product-colors/{slug}','FrontEndController@procolor');
    Route::get('/product-sizes/{slug}','FrontEndController@prosize');
    Route::get('/client-feedback','FrontEndController@allfeedback');
    Route::get('/gallery','FrontEndController@gallery');
    Route::get('/config','FrontEndController@config');
    Route::get('/highlight','FrontEndController@highlight');
    Route::get('documents', 'FrontEndController@documents');

    // cart manage
    Route::post('add-to-cart','ShoppingCartController@detailscart');
    Route::post('/cart','ShoppingCartController@cartstore');
    Route::post('/cart-clear','ShoppingCartController@cartEmpty');
    Route::get('/cart','ShoppingCartController@cartshow');
    Route::get('/checkout','ShoppingCartController@checkout');
    Route::post('/cart/increment/{product_id}/{product_size}', 'ShoppingCartController@cartincrement');
    Route::post('/cart/decrement/{product_id}/{product_size}', 'ShoppingCartController@cartdecrement');
    Route::post('/cart/delete/{product_id}/{product_size}', 'ShoppingCartController@cartdestroy');

    Route::post('/wishlist','ShoppingCartController@wishstore');
    Route::get('/wishlist','ShoppingCartController@wishshow');
    Route::delete('/wishlist/delete/{productId}', 'ShoppingCartController@wishdestroy');

    Route::post('/compare','ShoppingCartController@comparestore');
    Route::get('/compare','ShoppingCartController@compareshow');
    Route::delete('/compare/delete/{productId}', 'ShoppingCartController@comparedestroy');

    // Customer route
    Route::post('/customer/login','CustomerController@login');
    Route::post('/customer/register','CustomerController@register');
    Route::post('/customer/verified','CustomerController@verify');
    Route::put('/customer/resend/verify','CustomerController@resendverify');
    Route::post('/customer/forget-password','customerController@forgetpassword');
    Route::post('/customer/forget-password/reset','customerController@fpassreset');
    Route::post('/track/order','CustomerController@trackOrder');
    Route::get('track/order/result/{trackId}','CustomerController@trackResult');
    Route::get('/customer/order/note/{id}','CustomerController@ordernote');
    Route::post('customer/coupon-apply','CustomerController@couponapply');
    
    Route::get('/customer/related-product-account','CustomerController@relatedProAccount');
});

Route::group(['namespace' => 'Api','prefix'=>'v1','middleware' =>'auth:customer'], function(){
    Route::get('/customer/account','CustomerController@account');
    Route::get('/customer/account/overview','CustomerController@accountoverview');
    Route::get('/customer/profile/edit','CustomerController@editprofile');
    Route::post('/customer/profile/update','CustomerController@profileUpdate');
    Route::post('/customer/order/save','CustomerController@orderSave');
    Route::get('/customer/order','CustomerController@myorder');
    Route::get('/customer/order/invoice/{order_id}','CustomerController@orderInvoice');
    Route::post('/customer/product/review','CustomerController@customerReview');
    Route::get('/customer/reviews','CustomerController@reviews');
    Route::post('/customer/product/comment','CustomerController@customerComment');
    Route::post('/customer/logout','CustomerController@logout');
    Route::post('/customer/password/change','CustomerController@passwordchange');
    Route::post('/customer/point-apply','CustomerController@pointapply');
    
   

});
