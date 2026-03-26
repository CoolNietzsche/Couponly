<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; 

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        $stores = Cache::remember("stores_page_{$page}", 60, function () {
            return Store::withCount('coupons')
                ->latest()
                ->paginate(12);
        });

        return view('stores.index', compact('stores'));
    }

    public function setup()
    {
        $user = Auth::user();

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

        if (!$user->hasRole('merchant')) {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $store = Store::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name) . '-' . uniqid(),
            'country' => $request->country,
            'logo' => $logoPath,
            'user_id' => $user->id,
        ]);

        Cache::forget('stores_page_1');

        return redirect()->route('home')->with('success', 'Store created successfully!');
    }

    public function merchantDashboard()
    {
        $user = Auth::user();

        if (!$user->hasRole('merchant')) {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        $store = $user->store()->first();

        if (!$store) {
            return redirect()->route('store.setup')->with('info', 'Please create your store first.');
        }

        $coupons = $store->coupons()
            ->latest()
            ->paginate(10);

        $stats = Cache::remember("store_stats_{$store->id}", 60, function () use ($store) {
            return [
                'totalCoupons' => $store->coupons()->count(),
                'activeCoupons' => $store->coupons()->where('active', true)->count(),
                'totalCouponUsages' => $store->coupons()->withCount('usages')->sum('usages_count'),
            ];
        });

        return view('merchant.dashboard', [
            'store' => $store,
            'coupons' => $coupons,
            'totalCoupons' => $stats['totalCoupons'],
            'activeCoupons' => $stats['activeCoupons'],
            'totalCouponUsages' => $stats['totalCouponUsages'],
        ]);
    }
}