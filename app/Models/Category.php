<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'icon'];

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}