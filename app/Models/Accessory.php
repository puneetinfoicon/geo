<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Accessory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'relatedProduct',
        'created_at',
        'updated_at',
    ];

    public function get_products()
    {
        return $this->belongsTo(Product::class, 'relatedProduct');
    }
}
