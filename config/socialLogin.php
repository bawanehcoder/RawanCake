<?php
return [
    'guards' => [
        'web'
    ],
    'allowed_providers' => [
        'facebook',
        'instagram',

        'google',
//        'twitter',
    ],
    'redirect_after_login_to' => 'home',
    'redirect_after_register_to' => 'home',
    'redirect_on_failed_to' => 'login',
];
