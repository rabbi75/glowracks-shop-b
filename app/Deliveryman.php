<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Deliveryman extends Authenticatable
{
    protected $guard = 'deliveryman';

    protected $fillable = [
        'phonenumber','email', 'password',
    ];
    protected $hidden = [
            'password',
    ];
}
