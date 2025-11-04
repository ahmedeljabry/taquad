<?php

return [
    'edit_window_seconds' => env('MESSAGING_EDIT_WINDOW_SECONDS', 120),
    'revoke_window_seconds' => env('MESSAGING_REVOKE_WINDOW_SECONDS', 120),
    'draft_cache_ttl' => env('MESSAGING_DRAFT_CACHE_TTL', 3600),
    'presence_heartbeat_seconds' => env('MESSAGING_PRESENCE_HEARTBEAT_SECONDS', 30),
    'broadcast_queue' => env('MESSAGING_BROADCAST_QUEUE', 'broadcasts'),
    'attachments' => [
        'max_files' => 5,
        'max_size_kb' => 10240,
        'max_image_width' => 4096,
        'max_image_height' => 4096,
        'allowed_mimes' => [
            'image/jpeg',
            'image/png',
            'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ],
    ],
];
