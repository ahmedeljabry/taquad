<?php

return [
    'oauth_client_id' => env('TRACKER_OAUTH_CLIENT_ID', 'taquad-tracker-desktop'),
    'authorization_code_ttl' => env('TRACKER_OAUTH_CODE_TTL', 600),
    'refresh_token_ttl_days' => env('TRACKER_REFRESH_TTL_DAYS', 30),
    'access_token_expires_in' => env('TRACKER_ACCESS_TOKEN_TTL', 3600),
    'access_token_scopes' => [
        'tracker:read',
        'tracker:write',
    ],
    'access_token_abilities' => [
        'tracker:use',
    ],
];
