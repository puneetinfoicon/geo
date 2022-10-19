<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Maccessory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function get_products()
    {
        return $this->belongsTo(Product::class, 'relatedProduct');
    }

}
