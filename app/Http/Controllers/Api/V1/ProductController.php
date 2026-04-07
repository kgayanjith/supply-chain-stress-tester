<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('media', 'category')->where('status', 1)->get();
            // dd($products);
            $products = ProductResource::collection($products);
            return response()->json([
                'status'  => 'success',
                'message' => 'Products fetched successfully',
                'data'    => $products,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to fetch products',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }
}
