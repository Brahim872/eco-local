<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UsersSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    protected $rows;

    public function __construct()
    {
        $this->rows = config('userpermission.users');
    }


    public function run()
    {
        foreach ($this->rows as $row) {
            $user = User::find($row['id']);
            $role = $row['role'];
            unset($row['role']);
            if (!$user) {
                $user = new User;
                $user->fill($row);
                $user->save();
            } else {
                $user->update($row);
            }

            $user->roles()->detach();

            $user->assignRole(Role::where('name', '=', $role)->where('guard_name', '=', "web")->get('name')->first()->name);

        }
    }
}
