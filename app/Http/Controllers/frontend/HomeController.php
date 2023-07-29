<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subCategories = $categories->flatMap->sub_categories();
        // dd($categories);
        return view('frontend.layout.layout')->with(['categories' => $categories, 'subCategories' => $subCategories]);
    }
}
