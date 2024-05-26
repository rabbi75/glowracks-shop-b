<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [];
 
    public function sizes()
    {
        return $this->belongsToMany('App\Size','productsizes')->withTimestamps();
    }
    public function colors()
    {
        return $this->belongsToMany('App\Color','productcolors')->withTimestamps();
    }
    public function image(){
      return $this->hasOne('App\Productimage','product_id','id');
    }
    public function images(){
      return $this->hasMany('App\Productimage','product_id');
    }
    public function reviews(){
      return $this->hasMany('App\Review','product_id');
    }
    public function category(){
      return $this->hasOne('App\Category','id','proCategory');
    }
    public function subcategory(){
      return $this->hasOne('App\Subcategory','id','proSubcategory');
    }
    public function categories(){
        return $this->belongsTo('App\Category', 'proCategory');
	}
    public function childCategory(){
        return $this->hasOne('App\Childcategory', 'id', 'proChildCategory');
	}
    public function brand(){
        return $this->hasOne('App\Brand', 'id','proBrand');
    }
}
