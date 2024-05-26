<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
	public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function childcategories(){
    	return $this->hasMany('App\Childcategory')->where('status',1);
    }

    public function productcount(){
        return $this->hasMany('App\Product','proSubcategory')->where('status',1);
    }



}
