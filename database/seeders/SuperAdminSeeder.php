<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {

        $superAdmin = User::create([
            'email' => 'zoo@zoo.com',
                'name' => 'Super Admin',
                'password' => Hash::make('zoo@zoo.com'),
                'type' => 'admin',
        ]);


        $abilities = Config::get('abilities', []);

        $role = Role::create([
            'name' => 'super-admin',
        ]);

        foreach ($abilities as $ability => $value) {
            RoleAbility::create([
                'role_id' => $role->id,
                'ability' => $ability,
                'type' => 'allow',
            ]);
        }

        $superAdmin->roles()->syncWithoutDetaching([$role->id]);

    }
}
