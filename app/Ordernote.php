<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordernote extends Model
{
    protected $casts = [
    'created_at'  => 'date:d M Y',
    'updated_at' => 'datetime:h:i A',
];
}
