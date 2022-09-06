<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'address',
        'post_code',
        'city_name',
        'country_name'
    ];

}
