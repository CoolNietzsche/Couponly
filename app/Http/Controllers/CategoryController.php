<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        $page = request('page', 1);

        // Cache each page separately
        $categories = Cache::remember("categories_page_$page", 60, function () use ($page) {
            return Category::withCount('coupons')->paginate(12, ['*'], 'page', $page);
        });

        return view('categories.index', compact('categories'));
    }
}