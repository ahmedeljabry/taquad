<?php

return [
    'enabled' => env('FEATURE_HOURLY_LIFECYCLE', false),

    'week' => [
        'start'       => env('HOURS_WEEK_START', 'mon_00_00_utc'),
        'edit_cutoff' => env('HOURS_WEEK_EDIT_CUTOFF', 'mon_12_00_utc'),
        'review_end'  => env('HOURS_REVIEW_END', 'fri_23_59_utc'),
    ],

    'billing' => [
        'client_charge_at' => env('HOURS_CLIENT_CHARGE', 'mon_00_30_utc'),
        'funds_release_at' => env('HOURS_FUNDS_RELEASE', 'wed_00_00_utc'),
    ],

    'segments' => [
        'size_minutes'          => (int) env('SEGMENT_SIZE_MIN', 10),
        'screenshot_jitter_sec' => (int) env('SCREENSHOT_JITTER_SEC', 120),
    ],

    'fees' => [
        'platform_rate' => (float) env('HOURS_PLATFORM_FEE_RATE', 0.10),
        'tax_rate'      => (float) env('HOURS_TAX_RATE', 0.00),
    ],

    'privacy' => [
        'retention_days' => (int) env('PRIVACY_RETENTION_DAYS', 30),
    ],

    'channels' => [
        'user'     => env('REVERB_USER_CHANNEL', 'user'),
        'contract' => env('REVERB_CONTRACT_CHANNEL', 'contract'),
    ],
];
