<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Submenu;

class Menu extends Model
{
    use HasFactory;

    public function submenuss()
    {
        return $this->hasMany(Submenu::class);
    }
}
