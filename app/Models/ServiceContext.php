<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceContext extends Model
{
    use HasFactory;
    protected $table = "services_contexts";
    protected $guarded = [];
}
