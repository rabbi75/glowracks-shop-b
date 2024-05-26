<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function image(){
      return $this->hasOne('App\Productimage','product_id','product_id');
    }
}
