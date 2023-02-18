<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CartDetails;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cart_id',
        'user_id',
        'code',
        'is_active'
    ];

    public function details()
    {
        return $this->hasMany(CartDetails::class, 'cart_id', 'id');
    }
}
