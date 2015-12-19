<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */
    'roles'         => [
        'entity' => Beacon\Api\Auth\Entities\Role::class,
    ],
    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    |
    | Available drivers: config|doctrine
    | When set to config, add the permission names to list
    |
    */
    'permissions'   => [
        'driver' => 'doctrine',
        'entity' => LaravelDoctrine\ACL\Permissions\Permission::class,
    ]
];
