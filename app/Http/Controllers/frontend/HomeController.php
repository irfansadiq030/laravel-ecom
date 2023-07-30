<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subCategories = $categories->flatMap->sub_categories();

        $new_products = Product::with('productImages', 'subCategory', 'Category')->where('trendy','no')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $trendyProducts = Product::with('productImages', 'subCategory', 'Category')
            ->where('trendy', 'yes')
            ->take(8)
            ->get();

        return view('frontend.layout.layout')->with(['categories' => $categories, 'subCategories' => $subCategories, 'new_products' => $new_products, 'trendy_products' => $trendyProducts ]);
    }
}
