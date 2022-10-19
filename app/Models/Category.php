<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    public function subcategoriess()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'products_categories');
    }
}
