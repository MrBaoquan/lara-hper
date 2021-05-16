<?php

return [

    "database" => [
        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'larahper_users',
        'users_model' => Mrba\LaraHper\Models\WXUser::class,

        // Role table and model.
        'roles_table' => 'larahper_roles',
        //'roles_model' => Encore\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'larahper_permissions',
        // 'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table' => 'larahper_menu',
        // 'menu_model' => Encore\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table' => 'larahper_operation_log',
        'user_permissions_table' => 'larahper_user_permissions',
        'role_users_table' => 'larahper_role_users',
        'role_permissions_table' => 'larahper_role_permissions',
        'role_menu_table' => 'larahper_role_menu',
    ],

    // 微信模拟授权
    "wechat_mock" => env('WECHAT_OAUTH_MOCK'),
    // 微信授权代理服务器地址
    "wechat_oauth_proxy" => env('WECHAT_OAUTH_PROXY'),

    // 用户实例
    'users_model' => Mrba\LaraHper\Models\WXUser::class,

    "guard" => "larahper",
];
