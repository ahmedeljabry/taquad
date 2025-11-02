<?php

return [
    /*
    |-------------------------------------
    | Messenger display name
    |-------------------------------------
    */
    'name' => 'Live chat',

    /*
    |-------------------------------------
    | The disk on which to store added
    | files and derived images by default.
    |-------------------------------------
    */
    'storage_disk_name' => 'chat',

    /*
    |-------------------------------------
    | Routes configurations
    |-------------------------------------
    */
    'routes'     => [
        'prefix'     => "inbox",
        'middleware' => ['web','auth'],
        'namespace'  => "App\Http\Controllers\Chat",
    ],
    'api_routes' => [
        'prefix'     => "inbox/api",
        'middleware' => ['api'],
        'namespace'  => "App\Http\Controllers\Chat\Api",
    ],

    /*
    |-------------------------------------
    | Pusher API credentials
    |-------------------------------------
    */
    'pusher' => [
        'key'     => env('REVERB_APP_KEY', env('PUSHER_APP_KEY')),
        'secret'  => env('REVERB_APP_SECRET', env('PUSHER_APP_SECRET')),
        'app_id'  => env('REVERB_APP_ID', env('PUSHER_APP_ID')),
        'options' => [
            'host'      => env('REVERB_HOST', env('PUSHER_HOST', '127.0.0.1')),
            'port'      => (int) env('REVERB_PORT', env('PUSHER_PORT', 6001)),
            'scheme'    => env('REVERB_SCHEME', env('PUSHER_SCHEME', 'http')),
            'useTLS'    => env('REVERB_SCHEME', env('PUSHER_SCHEME', 'http')) === 'https',
            'encrypted' => env('REVERB_SCHEME', env('PUSHER_SCHEME', 'http')) === 'https',
        ],
    ],

    /*
    |-------------------------------------
    | User Avatar
    |-------------------------------------
    */
    'user_avatar' => [
        'folder' => 'users-avatar',
        'default' => 'avatar.png',
    ],

    /*
    |-------------------------------------
    | Gravatar
    |
    | imageset property options:
    | [ 404 | mp | identicon (default) | monsterid | wavatar ]
    |-------------------------------------
    */
    'gravatar' => [
        'enabled'    => false,
        'image_size' => 200,
        'imageset'   => 'identicon'
    ],

    /*
    |-------------------------------------
    | Attachments
    |-------------------------------------
    */
    'attachments' => [
        'folder'              => 'attachments',
        'download_route_name' => 'attachments.download',
        'allowed_images'      => (array) ['png','jpg','jpeg','gif'],
        'allowed_files'       => (array) ['zip','rar','txt', 'pdf', 'mp3', 'webm' , 'audio'],
        'max_upload_size'     => 10, // MB
    ],

    /*
    |-------------------------------------
    | Messenger's colors
    |-------------------------------------
    */
    'colors' => (array) [
        '#2180f3',
        '#2196F3',
        '#00BCD4',
        '#3F51B5',
        '#673AB7',
        '#4CAF50',
        '#FFC107',
        '#FF9800',
        '#ff2522',
        '#9C27B0',
    ],

    /*
    |-------------------------------------
    | Sounds
    | You can enable/disable the sounds and
    | change sound's name/path placed at
    | `public/` directory of your app.
    |
    |-------------------------------------
    */
    'sounds' => [
        'enabled'     => true,
        'public_path' => 'js/chatify/sounds',
        'new_message' => 'new-message-sound.mp3',
    ],

    /*
    |-------------------------------------
    | Voice notes
    |-------------------------------------
    */
    'voice_notes' => [
        'enabled'      => env('CHATIFY_VOICE_NOTES', true),
        'max_seconds'  => (int) env('CHATIFY_VOICE_MAX_SECONDS', 180),
        'formats'      => array_filter(array_map('trim', explode(',', env('CHATIFY_VOICE_FORMATS', 'webm,ogg,m4a,mp3,wav')))),
        'storage_disk' => env('CHATIFY_VOICE_DISK', env('FILESYSTEM_DISK', config('chatify.storage_disk_name', 'chat'))),
    ],
];
