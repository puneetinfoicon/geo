<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produkter;

class SubProdukter extends Model
{
    use HasFactory;

    public function produkterss()
    {
        return $this->hasOne(Produkter::class);
    }
}
