<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productcolor extends Model
{
    public function color(){
      return $this->hasOne('App\Color','id','color_id');
    }
}
