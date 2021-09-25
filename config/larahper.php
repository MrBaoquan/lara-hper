<?php

use Mrba\LaraHper\Models\User;

return [

    'auth' => [

        'guard' => 'larahper',

        'guards' => [
            'larahper' => [
                'driver' => 'sanctum',
                'provider' => 'larahper',
            ],
        ],

        'providers' => [
            'larahper' => [
                'driver' => 'eloquent',
                'model' => \Mrba\LaraHper\Models\User::class,
            ],
        ],

    ],

    "database" => [
        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'larahper_users',
        'users_model' => Mrba\LaraHper\Models\User::class,

        // Pivot table for table above.
        'operation_log_table' => 'larahper_operation_log',
    ],

    // 微信模拟授权
    "wechat_mock" => env('WECHAT_OAUTH_MOCK'),
    // 微信授权代理服务器地址
    "wechat_oauth_proxy" => env('WECHAT_OAUTH_PROXY'),
];
