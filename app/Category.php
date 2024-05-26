<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable=[];
    
    public function subcategories(){
      return $this->hasMany('App\Subcategory')->where('status',1);
    }
    public function childcategories(){
      return $this->hasManyThrough('App\Childcategory','App\Subcategory');
    }
    public function products(){
      return $this->hasMany('App\Product', 'proCategory');
	 }
    public function productcount(){
      return $this->hasMany('App\Product', 'proCategory');
   }
   public function colors()
    {
        return $this->belongsToMany('App\Color','productcolors')->distinct();
    }
   public function sizes()
    {
        return $this->belongsToMany('App\Size','productsizes')->distinct();
    }
   
}
