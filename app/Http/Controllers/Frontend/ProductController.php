<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(){

        $allproducts = Product::where('status', 1)->with('media','category')->get();

        return Inertia::render('Frontend/Products/Index',['allproducts' => $allproducts]);
    }
}
