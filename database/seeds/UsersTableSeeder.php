<?php

use App\Models\Trust\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // find or create user admin
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'dev.fresher@greenglobal.vn'],
            [
                'full_name' => 'Super Admin',
                'password' => bcrypt('tuan1234'),
                'remember_token' => str_random(60),
            ]
        );

        // find or create role admin
        $roleSuperAdmin = Role::firstOrCreate(
            ['name' => Role::SUPER_ADMIN],
            [
                'display_name' => 'Administrator',
                'description' => 'User is allowed to manage all system.',
            ]
        );
        // attach roles
        if (!$user->hasRole(Role::SUPER_ADMIN)) {
            $user->attachRole($roleSuperAdmin);
        }

    }
}
