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

    protected $appends = [
        'gender_read'
    ];

    /**
     * @return string
     */
    public function getGenderReadAttribute()
    {
        return genderStatus($this->gender);
    }

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
    protected function birthdate(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => date('d/m/Y', strtotime($value)),
            set: static fn ($value) => date('Y-m-d', strtotime($value)),
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


    /**
     * @return object
     */
    public function address(): object
    {
        return $this->hasOne(Address::class);
    }
}
