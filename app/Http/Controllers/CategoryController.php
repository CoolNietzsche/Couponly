<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Get the current page for the cache key
        $page = $request->input('page', 1);

        // Cache for 60 minutes. It counts only active and non-expired coupons.
        $categories = Cache::remember("categories_page_{$page}", 3600, function () {
            return Category::withCount(['coupons' => function ($query) {
                $query->where('active', true)->where('expire_date', '>=', now());
            }])
            ->orderBy('name', 'asc')
            ->paginate(12);
        });

        return view('categories.index', compact('categories'));
    }
}