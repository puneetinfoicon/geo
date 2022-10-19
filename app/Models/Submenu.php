<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Submenu extends Model
{
    use HasFactory;

    public function menuss()
    {
        return $this->hasOne(Menu::class,'id','menu_id');
    }
}
