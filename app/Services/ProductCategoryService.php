<?php

namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductCategoryService
{
    /**
     * Create a new class instance.
     */
    public function create(array $data): ProductCategory
    {
        return DB::transaction(function () use ($data) {

            $productcategory = ProductCategory::create([
                'name' => trim($data['name']),
                'description' => trim($data['description'] ?? ''),
                'status' => (bool) ($data['status'] ?? 1),
            ]);

            $productcategory->addMedia($data['image'])->toMediaCollection('productcategories');


            return $productcategory->refresh();
        });
    }

    public function update(ProductCategory $productcategory, array $data): ProductCategory
    {
        return DB::transaction(function () use ($productcategory, $data) {

            $productcategory->update([
                'name' => trim($data['name']),
                'description' => trim($data['description'] ?? ''),
                'status' => (bool) ($data['status'] ?? 1),
            ]);


            if (!empty($data['image']) && $data['image'] instanceof UploadedFile) {
                $productcategory->clearMediaCollection('productcategories');
                $productcategory->addMedia($data['image'])->toMediaCollection('productcategories');
            }



            return $productcategory->refresh();
        });
    }
}
