<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        try {
            $productcategories = ProductCategory::with('media')->where('status', 1)->get();
            // dd($productcategories);
            $productcategories = ProductCategoryResource::collection($productcategories);
            return response()->json([
                'status'  => 'success',
                'message' => 'Categories fetched successfully',
                'data'    => $productcategories,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to fetch categories',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }
}
