<?php

return [

    'users' => [
        [
            'id' => 1,
            'name' => 'super admin',
            'email' => 'superadmin@example.com',
            'password' => 'Pa$$w0rd!',
            'role' => 'super-admin',
        ],
    ],


    'roles' => [
        ["id" => 1, "name" => "super-admin"],
        ["id" => 2, "name" => "company"],

    ],

    'permissions' => [
        [
            'name' => 'permission',
            'category' => 'permission',
            'access' => [
                "super-admin" => ["read", "create", "delete"],
            ]
        ],
        [
            'name' => 'role',
            'category' => 'permission',
            'access' => [
                "super-admin" => ["read", "create", "delete"],
            ]
        ],
        [
            'name' => 'company',
            'category' => 'company',
            'access' => [
                "super-admin" => ["read", "create", "delete"],
            ]
        ],
        [
            'name' => 'user',
            'category' => 'user',
            'access' => [
                "super-admin" => ["read", "create", "delete"],
                "company" => ["read", "create", "delete"],
            ]
        ],
    ],


];
