<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure the 'admin' role exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create admin user if not exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@couponly.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // change this later
            ]
        );

        // Assign role if not already assigned
        if (! $admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }
    }
}
