<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Coupon;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Coupon $coupon): bool
    {
        // Merchants can only view coupons from their stores, admins can view all
        return $user->hasRole('admin') || $coupon->store->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only merchants with stores and admins can create coupons
        if ($user->hasRole('admin')) {
            return true;
        }
        
        if ($user->hasRole('merchant')) {
            // Check if the merchant has at least one store
            return $user->store()->exists();
        }
        
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Coupon $coupon): bool
    {
        // Merchants can update coupons from their stores, admins can update all
        return $user->hasRole('admin') || $coupon->store->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Coupon $coupon): bool
    {
        // Merchants can delete coupons from their stores, admins can delete all
        return $user->hasRole('admin') || $coupon->store->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Coupon $coupon): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Coupon $coupon): bool
    {
        return false;
    }
}