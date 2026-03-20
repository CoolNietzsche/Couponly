<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\Feedback;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
    {
        $coupons = Coupon::where('is_exclusive', true)
            ->where('active', true)
            ->with(['store', 'category'])
            ->take(3)
            ->get();

             $popularCoupons = Coupon::with(['store', 'category'])
            ->whereNotNull('tags')
            ->where('active', true)
            ->take(5)
            ->get();

              $topStores = Store::with(['coupons' => function ($query) {
            $query->where('expire_date', '>=', now())->where('active', true)->take(1);
        }])->take(5)->get();

    //  $featuredStore = Store::where('slug', 'amazon')->with(['coupons' => function ($query) {
    //         $query->where('expire_date', '>=', now());
    //     }])->first();


        //   $collectionStores = Store::where('slug', '!=', 'amazon')
        //     ->with(['coupons' => function ($query) {
        //         $query->where('expire_date', '>=', now());
        //     }])
        //     ->get();

            
        $popularCarouselCoupons = Coupon::whereIn('code', ['ADHUA10', 'AMAZONFS', 'ALIBABA30'])
            ->where('active', true)
            ->with(['store', 'category'])
            ->get();

        // $feedback = Feedback::all();

        $categories = Category::take(10)->get();
        
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

        return view('home', compact('coupons', 'popularCoupons', 'topStores',   'popularCarouselCoupons',  'categories', 'bogoCoupons', 'endingSoonCoupons', 'advertisements'));
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