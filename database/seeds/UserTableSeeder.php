<?php

use Illuminate\Database\Seeder;
use GeCo\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('nombre','user')->first();
        $role_admin = Role::where('nombre','admin')->first();

        $user = new User();
        $user->name="User";
        $user->email="user@mail.com";
        $user->password = bcrypt('query');
        $user->save;
        $user->roles()->attach($role_user);

         $user = new User();
        $user->name="Admin";
        $user->email="admin@mail.com";
        $user->password = bcrypt('query');
        $user->save;
        $user->roles()->attach($role_admin);
    }
}
