<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productcategories = ProductCategory::with('media')->get();
        // dd($productcategories);
        return Inertia::render('PCategory/Index', ['productcategories' => $productcategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('PCategory/CreateUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request, ProductCategoryService $service)
    {
        // $validated = $request->validated();
        // dd($validated);

        $service->create($request->validated());

        return redirect()
            ->route('pcategory.index')
            ->with('success', 'Product Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $productcategories = ProductCategory::find($id);

        return Inertia::render('PCategory/CreateUpdate', ['productcategories' => $productcategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $pcategory, ProductCategoryService $service)
    {
        // dd($request);
        $service->update($pcategory, $request->validated());

        return redirect()
            ->route('pcategory.index')
            ->with('success', 'Product category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $pcategory)
    {
        $pcategory->delete();
        
        return redirect()
            ->route('pcategory.index')
            ->with('success', 'Product Category deleted successfully.');
    }
}
