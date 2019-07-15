<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'city_id', 'area_id', 'street', 'house', 'additional_info'
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }
}
