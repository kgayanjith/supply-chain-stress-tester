<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['media', 'category'])->get();

        return Inertia::render('Products/Index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productcategories = ProductCategory::where(['status' => 1])->get();
        // dd($productcategories);
        return Inertia::render('Products/CreateUpdate', ['productcategories' => $productcategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, ProductService $service)
    {
        $data = $request->validated();

        if ($request->hasFile('feature_image')) $data['feature_image'] = $request->file('feature_image');
        if ($request->hasFile('first_image'))   $data['first_image']   = $request->file('first_image');
        if ($request->hasFile('second_image'))  $data['second_image']  = $request->file('second_image');
        if ($request->hasFile('third_image'))   $data['third_image']   = $request->file('third_image');

        $service->create($data);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $productcategories = ProductCategory::all();
        $products = Product::with('media')->find($id);
        // dd($products);
        return Inertia::render('Products/CreateUpdate', ['products' => $products, 'productcategories' => $productcategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, ProductService $service)
    {
        $data = $request->validated();

        if ($request->hasFile('feature_image')) $data['feature_image'] = $request->file('feature_image');
        if ($request->hasFile('first_image'))   $data['first_image']   = $request->file('first_image');
        if ($request->hasFile('second_image'))  $data['second_image']  = $request->file('second_image');
        if ($request->hasFile('third_image'))   $data['third_image']   = $request->file('third_image');

        $service->update($product, $data);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
       $product->delete();

       return redirect()
            ->route('product.index')
            ->with('success', 'Product deleted successfully.');
    }
}
