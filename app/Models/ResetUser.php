<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ResetUser extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'token',
        'created_at',
        'updated_at',
    ];

    public function get_users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
