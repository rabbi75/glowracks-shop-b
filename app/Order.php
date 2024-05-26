<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
   protected $primaryKey = 'orderIdPrimary';
    //
     protected $casts = [
        'created_at'  => 'date:d-m-Y',
    ];
    public function ordertype(){
      return $this->hasOne('App\Ordertype','id','orderStatus');
    }
    public function customer(){
      return $this->hasOne('App\Customer','id','customerId');
    }
    public function payment(){
      return $this->hasOne('App\Payment','orderId','orderIdPrimary');
    }
    public function shipping(){
      return $this->hasOne('App\Shipping','shippingPrimariId','orderIdPrimary');
    }
    public function orderdetails(){
      return $this->hasMany('App\Orderdetails','orderId','orderIdPrimary');
    }
    public function ordernotes(){
      return $this->hasMany('App\Ordernote','orderId','orderIdPrimary');
    }
}
