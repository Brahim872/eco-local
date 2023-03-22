<?php

return [

    'users' => [
        [
            'id' => 1,
            'name' => 'super backend',
            'email' => 'superadmin@example.com',
            'password' => 'Pa$$w0rd!',
            'role' => 'super-backend',
        ],
    ],


    'roles' => [
        ["id" => 1, "name" => "super-backend"],
        ["id" => 2, "name" => "company"],

    ],

    'permissions' => [
        [
            'name' => 'permission',
            'category' => 'permission',
            'access' => [
                "super-backend" => ["read", "create", "delete"],
            ]
        ],
        [
            'name' => 'role',
            'category' => 'permission',
            'access' => [
                "super-backend" => ["read", "create", "delete"],
            ]
        ],
        [
            'name' => 'company',
            'category' => 'company',
            'access' => [
                "super-backend" => ["read", "create", "delete"],
            ]
        ],
        [
            'name' => 'user',
            'category' => 'user',
            'access' => [
                "super-backend" => ["read", "create", "delete"],
                "company" => ["read", "create", "delete"],
            ]
        ],
        [
            'name' => 'contact',
            'category' => 'contact',
            'access' => [
                "super-backend" => ["read", "create", "delete"],
                "company" => ["read", "create", "delete"],
            ]
        ],
        [
            'name' => 'campaign',
            'category' => 'campaign',
            'access' => [
                "super-backend" => ["read", "create", "delete"],
                "company" => ["read", "create", "delete"],
            ]
        ],
    ],


];
