<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $casts = [
        'created_at'  => 'date:d M, Y',
    ];
    public function customer(){
        return $this->hasOne('App\Customer','id','customer_id');
    }
}
