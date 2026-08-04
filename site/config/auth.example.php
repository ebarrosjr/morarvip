<?php
return [
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', ''),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', ''),
        'redirect_uri' => env('GOOGLE_REDIRECT_URI', 'http://localhost:8763/users/login-with/google'),
        'scopes' => ['openid', 'email', 'profile'],
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', ''),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', ''),
        'redirect_uri' => env('FACEBOOK_REDIRECT_URI', 'http://localhost:8763/users/login-with/facebook'),
        'scopes' => ['email'],
    ],
];
