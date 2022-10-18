<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('slug','admin')->first();

        $user1                  = new User();
        $user1->name            = 'Admin';
        $user1->email           = 'admin1@gmail.com';
        $user1->password        = bcrypt('12345');
        $user1->created_at      = date('Y-m-d H:i:s');
        $user1->updated_at      = date('Y-m-d H:i:s');
        $user1->save();
        $user1->roles()->attach($admin);
    }
}
