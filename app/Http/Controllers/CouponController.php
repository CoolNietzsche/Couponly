<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Category;
use App\Models\Store;
use App\Models\CouponUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::with(['store', 'category', 'usages'])
            ->where('active', true);

        // Filters
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhereHas('store', function ($storeQuery) use ($keyword) {
                      $storeQuery->where('title', 'like', "%{$keyword}%");
                  })
                  ->orWhereHas('category', function ($categoryQuery) use ($keyword) {
                      $categoryQuery->where('title', 'like', "%{$keyword}%");
                  });
            });
        }

        if ($request->filled('store')) {
            $query->whereHas('store', function ($q) use ($request) {
                $q->where('slug', $request->store);
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('expire_date')) {
            $query->whereDate('expire_date', $request->expire_date);
        }

        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        $page = $request->get('page', 1);
        $cacheKey = 'coupons_' . md5(json_encode($request->all()) . '_page_' . $page);

        $coupons = Cache::remember($cacheKey, 60, function () use ($query) {
            return $query->latest()->paginate(6);
        });

        $categories = Cache::remember('categories', 60, function () {
            return Category::withCount('coupons')->get();
        });

        $stores = Cache::remember('stores', 60, function () {
            return Store::all();
        });

        $bogoCoupons = Cache::remember('bogo_coupons', 60, function () {
            return Coupon::with(['store', 'category'])
                ->where('type', 'Buy One Get One')
                ->where('expire_date', '>=', now())
                ->where('active', true)
                ->latest()
                ->limit(5)
                ->get();
        });

        $endingSoonCoupons = Cache::remember('ending_soon', 60, function () {
            return Coupon::with(['store', 'category'])
                ->where('expire_date', '>=', now())
                ->where('expire_date', '<=', now()->addDays(7))
                ->where('active', true)
                ->orderBy('expire_date', 'asc')
                ->limit(5)
                ->get();
        });

        $advertisements = Cache::remember('ads', 60, function () {
            return \App\Models\Advertisement::where('active', true)
                ->orderBy('position', 'asc')
                ->get();
        });

        return view('coupons.index', compact(
            'coupons',
            'categories',
            'stores',
            'bogoCoupons',
            'endingSoonCoupons',
            'advertisements'
        ));
    }

    public function storeUsage(Request $request, Coupon $coupon)
    {
        $request->validate([
            'worked' => 'required|boolean',
        ]);

        CouponUsage::create([
            'coupon_id' => $coupon->id,
            'worked' => $request->worked,
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
}