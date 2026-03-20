<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'store_id', 'category_id', 'code', 'type', 'title',
        'description', 'expire_date', 'is_exclusive', 'exclusive_amount', 'image', 'active', 'amount_of_discount'
    ];

    protected $dates = ['expire_date'];
    protected $casts = [
        'expire_date' => 'datetime',
        'active' => 'boolean',
        'amount_of_discount' => 'decimal',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }
}