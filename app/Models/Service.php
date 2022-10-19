<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Context;

class Service extends Model
{
    use HasFactory;

    public function contexts()
    {
        return $this->belongsToMany(Context::class,'services_contexts');
    }
}
