<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class BasicAdminPermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'permission main',
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',


            'role main',
            'role list',
            'role create',
            'role edit',
            'role delete',

            'user main',
            'user list',
            'user create',
            'user edit',
            'user delete',

            'client main',
            'client list',
            'client create',
            'client edit',
            'client delete',

            'product main',
            'product list',
            'product create',
            'product edit',
            'product delete',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,
                'category' => explode(' ',$permission)[0]]);
        }

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('permission list');
        $role1->givePermissionTo('role list');
        $role1->givePermissionTo('user list');

        $role2 = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $role2->givePermissionTo($permission);
        }


        $role3 = Role::create(['name' => 'super-admin']);
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('Pa$$w0rd!'),

        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('Pa$$w0rd!'),

        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
            'password' => Hash::make('Pa$$w0rd!'),

        ]);
        $user->assignRole($role1);
    }
}
