<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Person extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'birthdate',
        'gender'
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: static fn ($value) => tr_ucfirst_all($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => date('d.m.Y H:i', strtotime($value)),
        );
    }
}
