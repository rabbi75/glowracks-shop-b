<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordertype extends Model
{
    public function order(){
      return $this->hasMany('App\Order','orderStatus');
    }
}
