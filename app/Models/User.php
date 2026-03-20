<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles; // <-- import


class User extends Authenticatable
{
    
    use HasFactory, Notifiable, HasRoles; // <-- add HasRoles here

 
    protected $fillable = [
        'name',
        'email',
         'phone',   // add phone
        'password',
    ];

  
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function favorites()
    {
        return $this->belongsToMany(Coupon::class, 'user_favorites', 'user_id', 'coupon_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function store(): HasMany
    {
        return $this->hasMany(Store::class);
    }
}
