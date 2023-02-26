<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{

    use HasFactory;

    protected $primaryKey = "order_detail_id";

    protected $fillable = [
        'order_detail_id',
        'order_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, "product_id", "product_id");
    }
}
