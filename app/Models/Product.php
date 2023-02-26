<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = "product_id";

    public function category()
    {
    return $this->hasOne(Category::class, "category_id","category_id");
    }

    public function images()
    {
    return $this->hasMany(ProductImage::class,"product_image_id", "product_image_id");
    }
}
