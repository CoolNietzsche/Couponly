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

        // --- Original Commented Sections Preserved ---
        // $featuredStore = Store::where('slug', 'amazon')->with(['coupons' => function ($query) {
        //         $query->where('expire_date', '>=', now());
        //     }])->first();

        // $collectionStores = Store::where('slug', '!=', 'amazon')
        //     ->with(['coupons' => function ($query) {
        //         $query->where('expire_date', '>=', now());
        //     }])
        //     ->get();

        // $feedback = Feedback::all();

        // 3. Paginated Lists (Dynamic content)
        // We use unique page names ('p_page', 'b_page', 'e_page') so that 
        // flipping through one list doesn't reset the others.
        
        $popularCoupons = Coupon::with(['store', 'category'])
            ->whereNotNull('tags')
            ->where('active', true)
            ->paginate(10, ['*'], 'p_page');

        $bogoCoupons = Coupon::with(['store', 'category'])
            ->where('type', 'Buy One Get One')
            ->where('expire_date', '>=', now())
            ->where('active', true)
            ->latest()
            ->paginate(10, ['*'], 'b_page');

        $endingSoonCoupons = Coupon::with(['store', 'category'])
            ->where('expire_date', '>=', now())
            ->where('expire_date', '<=', now()->addDays(7))
            ->where('active', true)
            ->orderBy('expire_date', 'asc')
            ->paginate(10, ['*'], 'e_page');

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