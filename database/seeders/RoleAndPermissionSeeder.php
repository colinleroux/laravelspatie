<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
         //Reset cached roles and permissions
         app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-articles']);
        Permission::create(['name' => 'edit-articles']);
        Permission::create(['name' => 'delete-articles']);

        Permission::create(['name' => 'create-product']);
        Permission::create(['name' => 'list-product']);
        Permission::create(['name' => 'edit-product']);
        Permission::create(['name' => 'delete-product']);
       
        $adminRole = Role::create(['name' => 'Admin']);
        $editorRole = Role::create(['name' => 'Editor']);
        $productmanagerRole = Role::create(['name' => 'ProductManager']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-articles',
            'edit-articles',
            'delete-articles',
            'create-product',
            'list-product',
            'edit-product',
            'delete-product',

        ]);

        $editorRole->givePermissionTo([
            'create-articles',
            'edit-articles',
            'delete-articles',
        ]);

        $productmanagerRole->givePermissionTo([
            'create-product',
            'list-product',
            'edit-product',
            'delete-product',
        ]);
          // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Ed Editor',
            'email' => 'editor@example.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($editorRole);

        $user = \App\Models\User::factory()->create([
            'name' => 'Andrew Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        $user->assignRole($adminRole);

        $user = \App\Models\User::factory()->create([
            'name' => 'Peter Product',
            'email' => 'product@example.com',
            'password' => Hash::make('password')
        ]);
        
        $user->assignRole($productmanagerRole);
    }
}