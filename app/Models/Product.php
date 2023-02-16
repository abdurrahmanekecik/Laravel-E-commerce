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


    public function category()
    {
    return $this->hasOne(Category::class, "id","id");
    }

    public function images()
    {
    return $this->hasMany(ProductImage::class,"id", "id");
    }
}
