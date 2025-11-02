<?php

return [
    'server' => [
        'host'            => env('REVERB_HOST', '127.0.0.1'),
        'port'            => (int) env('REVERB_PORT', 8080),
        'scheme'          => env('REVERB_SCHEME', 'http'),
        'path'            => env('REVERB_PATH', ''),
        'max_request_size'=> (int) env('REVERB_MAX_REQUEST_SIZE', 10_000_000),
        'ping_interval'   => (int) env('REVERB_PING_INTERVAL', 30),
        'retry_interval'  => (int) env('REVERB_RETRY_INTERVAL', 2000),
    ],

    'apps' => [
        env('REVERB_APP_ID', 'app') => [
            'key'                         => env('REVERB_APP_KEY', 'app-key'),
            'secret'                      => env('REVERB_APP_SECRET', 'app-secret'),
            'capacity'                    => (int) env('REVERB_APP_CAPACITY', 100),
            'enable_client_messages'      => env('REVERB_CLIENT_MESSAGES', true),
            'enable_user_authentication'  => env('REVERB_USER_AUTH', true),
            'max_backend_events_per_min'  => (int) env('REVERB_MAX_EVENTS_PER_MIN', 60_000),
            'max_client_events_per_min'   => (int) env('REVERB_MAX_CLIENT_EVENTS_PER_MIN', 1_000),
            'allowed_origins'             => array_filter(
                array_map('trim', explode(',', env('REVERB_ALLOWED_ORIGINS', '')))
            ),
        ],
    ],

    'statistics' => [
        'enabled'  => env('REVERB_STATS_ENABLED', false),
        'interval' => (int) env('REVERB_STATS_INTERVAL', 60),
    ],

    'channels' => [
        'user_prefix'         => env('REVERB_USER_CHANNEL', 'user'),
        'contract_prefix'     => env('REVERB_CONTRACT_CHANNEL', 'contract'),
        'notification_prefix' => env('REVERB_NOTIFICATION_CHANNEL', env('REVERB_USER_CHANNEL', 'user')),
    ],
];
