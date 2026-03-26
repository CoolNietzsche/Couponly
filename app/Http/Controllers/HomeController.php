<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\Feedback;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Static Content Caching (Saved for 1 hour for better performance)
        $categories = Cache::remember('home_categories', 3600, function () {
            return Category::take(10)->get();
        });

        $advertisements = Cache::remember('home_ads', 3600, function () {
            return Advertisement::where('active', true)
                ->orderBy('position', 'asc')
                ->get();
        });

        $topStores = Cache::remember('home_topStores', 3600, function () {
            return Store::with(['coupons' => function ($query) {
                $query->where('expire_date', '>=', now())->where('active', true)->take(1);
            }])->take(5)->get();
        });

        // 2. Fixed Lists (Cached content for specific UI components)
        $coupons = Cache::remember('home_exclusive_coupons', 3600, function () {
            return Coupon::where('is_exclusive', true)
                ->where('active', true)
                ->with(['store', 'category'])
                ->take(3)
                ->get();
        });

        $popularCarouselCoupons = Cache::remember('home_carousel_coupons', 3600, function () {
            return Coupon::where('active', true)
                ->whereNotNull('image')
                ->latest()
                ->with(['store', 'category'])
                ->take(10)
                ->get();
        });

        // $featuredStore = Store::where('slug', 'amazon')->with(['coupons' => function ($query) {
        //         $query->where('expire_date', '>=', now());
        //     }])->first();

        // $collectionStores = Store::where('slug', '!=', 'amazon')
        //     ->with(['coupons' => function ($query) {
        //         $query->where('expire_date', '>=', now());
        //     }])
        //     ->get();

        // $feedback = Feedback::all();

        // 3. Lists 

        // Cache Popular Coupons
        $popularCoupons = Cache::remember("popular_coupons_list", 3600, function () {
            return Coupon::with(['store', 'category'])
                ->whereNotNull('tags')
                ->where('active', true)
                ->get(); // Fetching all results 
        });

        // Cache BOGO Coupons
        $bogoCoupons = Cache::remember("bogo_coupons_list", 3600, function () {
            return Coupon::with(['store', 'category'])
                ->where('type', 'Buy One Get One')
                ->where('expire_date', '>=', now())
                ->where('active', true)
                ->latest()
                ->get(); // Fetching all results instead of paginating
        });

        // Cache Ending Soon Coupons 
        $endingSoonCoupons = Cache::remember("ending_soon_list", 3600, function () {
            return Coupon::with(['store', 'category'])
                ->where('expire_date', '>=', now())
                ->where('expire_date', '<=', now()->addDays(7))
                ->where('active', true)
                ->orderBy('expire_date', 'asc')
                ->get(); // Fetching all results instead of paginating
        });

        return view('home', compact(
            'coupons',
            'popularCoupons',
            'topStores',
            'popularCarouselCoupons',
            'categories',
            'bogoCoupons',
            'endingSoonCoupons',
            'advertisements'
        ));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function favorites()
    {
        $favorites = auth()->check() ? auth()->user()->favorites()->get() : collect();
        return view('favorites', compact('favorites'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category_id = $request->input('category_id');
        
        $coupons = Coupon::query()
            ->where('active', true)
            ->when($query, fn($q) => $q->where('title', 'like', "%{$query}%")
                ->orWhere('code', 'like', "%{$query}%"))
            ->when($category_id, fn($q) => $q->where('category_id', $category_id))
            ->with(['store', 'category'])
            ->get();
        
        return view('search', compact('coupons', 'query', 'category_id'));
    }
}