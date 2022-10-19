<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Context extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(Context::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Context::class, 'parent_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'contextcategories');
    }

    public function search_categories()
    {
        return $this->belongsToMany(SearchCategory::class,'contextsearchcategories');
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class,'contextareas');
    }
}
