<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Category;
use App\Models\Store;
use App\Models\CouponUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
     public function index(Request $request)
    {
        $query = Coupon::with(['store', 'category', 'usages'])->where('active', true);

        // Apply filters
       // Apply filters
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

        $coupons = $query->latest()->paginate(8);
        $categories = Category::withCount('coupons')->get();
        $stores = Store::all();
        
        // Get BOGO coupons for display
        $bogoCoupons = Coupon::with(['store', 'category'])
            ->where('type', 'Buy One Get One')
            ->where('expire_date', '>=', now())
            ->where('active', true)
            ->latest()
            ->limit(5)
            ->get();
        
        // Get ending soon coupons
        $endingSoonCoupons = Coupon::with(['store', 'category'])
            ->where('expire_date', '>=', now())
            ->where('expire_date', '<=', now()->addDays(7))
            ->where('active', true)
            ->orderBy('expire_date', 'asc')
            ->limit(5)
            ->get();

        // Get active advertisements ordered by position
        $advertisements = \App\Models\Advertisement::where('active', true)
            ->orderBy('position', 'asc')
            ->get();

        // dd($coupons->count());

        return view('coupons.index', compact('coupons', 'categories', 'stores', 'bogoCoupons', 'endingSoonCoupons', 'advertisements'));
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