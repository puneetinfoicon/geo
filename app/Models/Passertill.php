<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passertill extends Model
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
