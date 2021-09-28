<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Access Token URL
    |--------------------------------------------------------------------------
    |
    | To access Keycloak we need to get fresh access_token first.
    |
    */

    'token_url'     => env('KEYCLOAK_TOKEN_URL'),

    /*
    |--------------------------------------------------------------------------
    | Keycloak notifications URL
    |--------------------------------------------------------------------------
    */

    'notify_url'    => env('KEYCLOAK_NOTIFY_URL'),

    /*
    |--------------------------------------------------------------------------
    | Keycloak client credentials
    |--------------------------------------------------------------------------
    */

    'client_id'     => env('KEYCLOAK_CLIENT_ID'),
    'client_secret' => env('KEYCLOAK_CLIENT_SECRET'),
];
