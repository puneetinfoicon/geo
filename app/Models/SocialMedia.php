<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class SocialMedia extends Model
{
    use HasFactory;
    protected $table = "social_media";
    protected $guarded = [];

    public function areas()
    {
        return $this->hasOne(Area::class,'id');
    }

}
