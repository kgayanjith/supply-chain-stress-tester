<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
   public function index()
   {

      $banners = Banner::where('status', 1)->with('media')->get();
      $categories = ProductCategory::where('status', 1)->with('media')->get();
      $latestproducts = Product::where('status', 1)->with('media', 'category')->latest()->take(4)->get();
      $featuredproducts = Product::where('status', 1)->with('media', 'category')->latest()->take(4)->get();
      $mostorderedproducts = Product::where('status', 1)->with('media', 'category')->take(4)->get();
      // dd($products);

      return Inertia::render('Frontend/Landing/Index', [
         'banners' => $banners,
         'categories' => $categories,
         'latestproducts' => $latestproducts,
         'featuredproducts' => $featuredproducts,
         'mostorderedproducts' => $mostorderedproducts
      ]);
   }
}
