<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Context;
use App\Models\Area;
use App\Models\Accessory;
use App\Models\Passertill;
use App\Models\UserProduct;
use App\Models\maccessories;

class Product extends Model
{
    use HasFactory;

        public function imagess(){
        return $this->hasMany(ProductImage::class);
    }

    public function accessoriess(){
        return $this->hasMany(Accessory::class, 'product_id');
    }
    public function maccessoriess(){
        return $this->hasMany(Maccessory::class, 'product_id');
    }

    public function passerss(){
        return $this->hasMany(Passertill::class, 'product_id');
    }
    public function relatedArea(){
        return $this->hasMany(RelatedArea::class, 'product_id');
    }

    // public function subcategoriess(){
    //     // return $this->hasOne(Subcategory::class ,'id', 'sub_category_id');
    //     return $this->belongsTo(Subcategory::class, 'sub_category_id');
    // }

    // public function categoriess(){
    //     // return $this->hasOne(Category::class, 'id', 'category_id');
    //     return $this->belongsTo(Category::class, 'category_id');

    // }

    // public function getQuantity(){

    //     return $this->hasOne(UserProduct::class);
    // }

    //

    public function categories()
    {
        return $this->belongsToMany(Category::class,'products_categories');
    }

    public function hasCategories(... $categories )
    {
        foreach ($categories as $category) {
            if ($this->categories->contains('id', $category)) {
                return true;
            }
        }
        return false;
    }

    public function search_categories()
    {
        return $this->belongsToMany(SearchCategory::class,'products_searchcategories');
    }

    public function hasSearchCategory(... $search_categories )
    {
        foreach ($search_categories as $category) {
            if ($this->search_categories->contains('id', $category)) {
                return true;
            }
        }
        return false;
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class,'products_areas');
    }

    public function hasareas(... $areas )
    {
        foreach ($areas as $area) {
            if ($this->areas->contains('id', $area)) {
                return true;
            }
        }
        return false;
    }

    public function contexts()
    {
        return $this->belongsToMany(Context::class,'products_contexts');
    }

    public function hascontexts(... $contexts )
    {
        foreach ($contexts as $context) {
            if ($this->contexts->contains('id', $context)) {
                return true;
            }
        }
        return false;
    }
}
