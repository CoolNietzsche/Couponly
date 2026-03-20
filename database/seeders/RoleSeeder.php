<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find or create the 'client' role
        $clientRole = Role::firstOrCreate(['name' => 'client']);

        // Find or create the 'merchant' role
        $merchantRole = Role::firstOrCreate(['name' => 'merchant']);

        // Find or create the 'admin' role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Find or create the 'delete articles' permission
        $deleteArticlesPermission = Permission::firstOrCreate(['name' => 'delete articles']);

        // Give the 'admin' role the 'delete articles' permission
        $adminRole->givePermissionTo($deleteArticlesPermission);
    }
}
