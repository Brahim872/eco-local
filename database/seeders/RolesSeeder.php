<?php

namespace Database\Seeders;


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesSeeder extends Seeder
{

    protected $roles = [
        ["id" => 1, "name" => "super-admin"],
        ["id" => 2, "name" => "company"],

    ];

    public function run()
    {
        Role::query()->delete();

        foreach ($this->roles as $index => $role) {

            Role::create(
                [
                    'id' => $role['id'],
                    'name' => $role['name']
                ]
            );
        }
    }
}
