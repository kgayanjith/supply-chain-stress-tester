<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
   public function index(){

   $banners = Banner::where('status', 1)->get();
   $categories = ProductCategory::where('status', 1)->get();
   // dd($categories);
    
    return Inertia::render('Frontend/Landing/Index', ['banners' => $banners, 'categories' => $categories]);

   } 
}
