<?php

namespace App\Traits;

use App\Models\Role;
trait HasRolesAndPermissions
{
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    public function hasRole(... $roles ) 
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }
}