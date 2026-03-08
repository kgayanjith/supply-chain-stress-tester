<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductCategory extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    
    protected $appends = ['image'];
    protected $fillable = ['name', 'description', 'status'];

    public function getImageAttribute()
    {
        $image = $this->getFirstMedia('productcategories');
        return $image ? $image->getUrl() : null;
    }
}
