<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'url',
        'type',
        'title_image',
        'alt_image',
        'created_at',
        'updated_at',
    ];

   // protected $guarded = [];

    public function get_products()
    {
        return $this->hasOne(Product::class);
    }
}
