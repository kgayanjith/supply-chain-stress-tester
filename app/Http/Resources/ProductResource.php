<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'status' => $this->status,
            'price' => $this->price,
            'category' => $this->category?->name ?? 'no category',
            'feature_image' => $this->getFirstMediaUrl('feature_image'),
            'product_images' => $this->getMedia('product_images')
                ->map(function ($media) {
                    return $media->getUrl();
                }),
        ];
    }
}
