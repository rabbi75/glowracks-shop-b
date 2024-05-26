<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   protected $casts = [
        'created_at'  => 'date:M d, Y H:i:s',
    ];
    public function customer(){
        return $this->hasOne('App\Customer','id','customer_id');
    }
}
