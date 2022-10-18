<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Context;

class Area extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class,'products_areas');
    }

    public function contexts()
    {
        return $this->belongsToMany(Context::class,'contextareas');
    }


}
