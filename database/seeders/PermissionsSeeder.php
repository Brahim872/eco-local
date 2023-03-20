<?php

namespace Database\Seeders;


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionsSeeder extends Seeder
{

    protected $accessList = [];
    protected $info = [];

    protected $permissions;

    public function __construct()
    {
        $this->permissions = config('userpermission.permissions');
    }


    public function run()
    {
//        Permission::query()->delete();
        $this->info['name'] = '';
        $p = 1;
        $a = [];
        foreach ($this->permissions as $data) {

            foreach ($data['access'] as $key => $access) {


                foreach ($access as $index => $permission) {
                    $a[$index] = $data['name'] . '.' . $permission;
                    if (Permission::where('name', '=', $data['name'] . '.' . $permission)->count() == 0) {

                        $this->info['id'] = $p;
                        $this->info['name'] = $data['name'] . '.' . $permission;
                        $this->info['guard_name'] = 'web';
                        $this->info['category'] = $data['category'];

                        Permission::updateOrCreate(['name' => $data['name'] . '.' . $permission], $this->info);
                        $p++;
                    }
                }

                $this->accessList[$key] = $a;
            }

            $this->rolePermission($this->accessList);
        }

    }

    private function rolePermission(array $accessList)
    {
        foreach ($accessList as $role => $permission) {
            if ($r = Role::where('name', '=', $role)->first()) {
                $r->givePermissionTo($permission);
            }
        }
    }


}
