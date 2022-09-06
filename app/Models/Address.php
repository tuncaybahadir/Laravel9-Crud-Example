<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'address',
        'post_code',
        'city_name',
        'country_name'
    ];

    /**
     * @return Attribute
     */
    protected function cityName(): Attribute
    {
        return Attribute::make(
            set: static fn ($value) => tr_ucfirst_all($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function countryName(): Attribute
    {
        return Attribute::make(
            set: static fn ($value) => tr_ucfirst_all($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function address(): Attribute
    {
        return Attribute::make(
            set: static fn ($value) => tr_ucfirst_all($value),
        );
    }

}
