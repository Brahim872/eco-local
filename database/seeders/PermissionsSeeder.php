<?php

namespace Database\Seeders;


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionsSeeder extends Seeder
{
    protected $permissions = [

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

        'company main',
        'company list',
        'company create',
        'company edit',
        'company delete',

        'contact main',
        'contact list',
        'contact create',
        'contact edit',
        'contact delete',

        'campaign main',
        'campaign list',
        'campaign create',
        'campaign edit',
        'campaign delete',

    ];
    protected $roleArray = [];
    protected $dataRole = [];
    protected $datas = [
        [
            'name' => 'permission',
            'category' => 'permission',
            'access' => [
                "read" => ["super-admin",'admin'],
                "create" => ["super-admin"],
                "delete" => ["super-admin"],
            ]
        ],
    ];

    public function run()
    {
        Permission::query()->delete();
        Role::query()->delete();

        $p = 1;
        foreach ($this->datas as $data) {
            foreach ($data['access'] as $key => $access) {

                $info['id'] = $p;
                $info['name'] = $data['name'] . '.' . $key;
                $info['guard_name'] = 'web';
                $info['category'] = $data['category'];

                Permission::create($info);
                $p++;
            }

        }


        $this->createRolesPermission($this->datas);

    }


    public function createRolesPermission($myData)
    {
        foreach ($myData as $data) {
            dump($data['access']);
            foreach ($data['access'] as $key => $access) {


            }
        }
    }
}
