<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class UserProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'user_id', 'quantity','created_at','updated_at', 'rating', 'comment'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
