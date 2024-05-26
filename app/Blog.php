<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $casts = [
        'created_at'  => 'date:d M, Y',
    ];

    public function blogcategory()
    {
        return $this->belongsTo('App\Blogcategory','blogcategory_id');
    }
}
