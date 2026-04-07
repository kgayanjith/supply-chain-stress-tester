<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService
{

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug     = Str::slug($name);
        $original = $slug;
        $count    = 1;

        while (
            Product::where('slug', $slug)
                   ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                   ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
    
    public function create(array $data): Product
    {
        return DB::transaction(function () use ($data) {

            $product = Product::create([
                'product_category_id' => $data['category'],
                'name'                => $data['name'],
                'slug' => $this->generateUniqueSlug($data['name']),
                'description'         => $data['description'] ?? null,
                'price'               => $data['price'],
                'quantity'               => $data['quantity'] ?? 0,
                'status' => (bool) ($data['status'] ?? 1),
            ]);


            if (!empty($data['feature_image'])) {
                $product->addMedia($data['feature_image'])
                    ->toMediaCollection('feature_image');
            }


            foreach (['first_image', 'second_image', 'third_image'] as $key) {
                if (!empty($data[$key])) {
                    $product->addMedia($data[$key])
                        ->withCustomProperties(['position' => $key])
                        ->toMediaCollection('product_images');
                }
            }


            return $product->refresh();
        });
    }

    public function update(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {

            $product->update([
                'product_category_id' => $data['category'],
                'name'                => $data['name'],
                'slug'                => $product->slug, 
                'description'         => $data['description'] ?? null,
                'price'               => $data['price'],
                'quantity'               => $data['quantity'] ?? 0,
                'status' => (bool) ($data['status'] ?? 1),
            ]);

            if (!empty($data['feature_image'])) {
                $product->clearMediaCollection('feature_image');
                $product->addMedia($data['feature_image'])
                    ->toMediaCollection('feature_image');
            }

            foreach (['first_image', 'second_image', 'third_image'] as $key) {
                if (!empty($data[$key])) {

                    $product->getMedia('product_images')
                        ->filter(fn($m) => $m->getCustomProperty('position') === $key)
                        ->each(fn($m) => $m->delete());

                    $product->addMedia($data[$key])
                        ->withCustomProperties(['position' => $key])
                        ->toMediaCollection('product_images');
                }
            }

            return $product->refresh();
        });
    }
}
