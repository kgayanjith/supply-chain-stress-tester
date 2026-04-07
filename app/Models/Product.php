<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'description',
        'price',
        'status',
        'quantity'

    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id')
                ->withDefault([
                    'name' => 'No Category',
                    'id'   => null,
                ]);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('feature_image')->singleFile();
        $this->addMediaCollection('product_images');
    }
}
