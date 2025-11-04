<?php

return [
    'default' => env('REVERB_SERVER', 'reverb'),

    'servers' => [
        'reverb' => [
            'host' => env('REVERB_SERVER_HOST', env('REVERB_HOST', '127.0.0.1')),
            'port' => (int) env('REVERB_SERVER_PORT', env('REVERB_PORT', 8080)),
            'path' => env('REVERB_SERVER_PATH', env('REVERB_PATH', '')),
            'hostname' => env('REVERB_HOST', '127.0.0.1'),
            'options' => [
                'tls' => [],
            ],
            'max_request_size' => (int) env('REVERB_MAX_REQUEST_SIZE', 10_000_000),
            'scaling' => [
                'enabled' => env('REVERB_SCALING_ENABLED', false),
                'channel' => env('REVERB_SCALING_CHANNEL', 'reverb'),
                'server' => [
                    'url' => env('REDIS_URL'),
                    'host' => env('REDIS_HOST', '127.0.0.1'),
                    'port' => env('REDIS_PORT', '6379'),
                    'username' => env('REDIS_USERNAME'),
                    'password' => env('REDIS_PASSWORD'),
                    'database' => env('REDIS_DB', '0'),
                    'timeout' => env('REDIS_TIMEOUT', 60),
                ],
            ],
            'pulse_ingest_interval' => env('REVERB_PULSE_INGEST_INTERVAL', 15),
            'telescope_ingest_interval' => env('REVERB_TELESCOPE_INGEST_INTERVAL', 15),
        ],
    ],

    'apps' => [
        'provider' => 'config',

        'apps' => [
            [
                'key' => env('REVERB_APP_KEY', 'app-key'),
                'secret' => env('REVERB_APP_SECRET', 'app-secret'),
                'app_id' => env('REVERB_APP_ID', 'app'),
                'options' => [
                    'host' => env('REVERB_HOST', '127.0.0.1'),
                    'port' => (int) env('REVERB_PORT', 8080),
                    'scheme' => env('REVERB_SCHEME', 'http'),
                    'useTLS' => env('REVERB_SCHEME', 'http') === 'https',
                    'path' => env('REVERB_PATH', ''),
                ],
                'allowed_origins' => array_filter(
                    array_map('trim', explode(',', env('REVERB_ALLOWED_ORIGINS', '*')))
                ),
                'ping_interval' => (int) env('REVERB_APP_PING_INTERVAL', env('REVERB_PING_INTERVAL', 30)),
                'activity_timeout' => (int) env('REVERB_APP_ACTIVITY_TIMEOUT', 30),
                'max_connections' => env('REVERB_APP_MAX_CONNECTIONS'),
                'max_message_size' => (int) env('REVERB_APP_MAX_MESSAGE_SIZE', 10_000_000),
            ],
        ],
    ],
];
