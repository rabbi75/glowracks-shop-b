<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productsize extends Model
{
     public function size(){
      return $this->hasOne('App\Size','id','size_id');
    }
}
