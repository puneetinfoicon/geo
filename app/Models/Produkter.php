<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\SubProdukter;

class Produkter extends Model
{
    use HasFactory;

    public function areas()
    {
        return $this->belongsToMany(Area::class,'produkterareas');
    }

    public function subProdukterss()
    {
        return $this->hasMany(SubProdukter::class);
    }
}
