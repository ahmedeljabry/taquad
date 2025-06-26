<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    // For now try to change your api keys here, I am going to see what is the problem with the config settings
    // Have a nice day
    // that mean not change it from dashboard ?yes
    // ok you will solve it in new version ?yes
    // thank you with pleasure :)
    
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => 'AeIQr8ndJC-9SaLYZk4NL1pAAH9dDH0WpKyCz0VEubqqwNOd2hFMd2zHjFOwu7_HNEnIZ458wZmcdUPp',
        'client_secret'     => 'EHSiKC1KEo8Hjb_JMaECpMEreMV9PtkgHJwJLNhB6hNyRAMqn7z4oRvQP9GaQv9tGMgcHuZv_IDLZB39',
        'app_id'            => '',
    ],
    'live' => [
        'client_id'         => '',
        'client_secret'     => '',
        'app_id'            => '',
    ],

    'payment_action' => 'Order', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => false, // Validate SSL when creating api client.
];
