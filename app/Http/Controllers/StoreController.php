<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::withCount('coupons')->get();
        return view('stores.index', compact('stores'));
    }

    public function setup()
    {
        $user = Auth::user();
        
        // Check if user is a merchant and doesn't already have a store
        if ($user->hasRole('merchant')) {
            $existingStore = $user->store()->first();
            if ($existingStore) {
                return redirect()->route('home')->with('info', 'You already have a store.');
            }
            
            return view('stores.setup');
        }
        
        return redirect()->route('home')->with('error', 'Access denied.');
    }

    public function storeSetup(Request $request)
    {
        $user = Auth::user();
        
        // Validate if user is a merchant
        if (!$user->hasRole('merchant')) {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle logo upload if provided
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Create store and associate with user
        $store = Store::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name) . '-' . uniqid(),
            'country' => $request->country,
            'logo' => $logoPath,
            'user_id' => $user->id,
        ]);

        return redirect()->route('home')->with('success', 'Store created successfully!');
    }

    public function merchantDashboard()
    {
        $user = Auth::user();
        
        // Check if user is a merchant
        if (!$user->hasRole('merchant')) {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        // Get the user's store
        $store = $user->store()->first();

        // If no store exists, redirect to setup
        if (!$store) {
            return redirect()->route('store.setup')->with('info', 'Please create your store first.');
        }

        // Get the store's coupons
        $coupons = $store->coupons()->latest()->get();
        
        // Get some statistics
        $totalCoupons = $coupons->count();
        $activeCoupons = $store->coupons()->where('active', true)->count();
        $totalCouponUsages = $store->coupons()->withCount('usages')->sum('usages_count');

        return view('merchant.dashboard', compact('store', 'coupons', 'totalCoupons', 'activeCoupons', 'totalCouponUsages'));
    }
}
