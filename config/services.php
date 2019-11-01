<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    '123_reg' => [
        'username' => env('123_REG_USERNAME'),
        'password' => env('123_REG_PASSWORD'),
        'login_url' => env('123_REG_LOGIN_URL', 'https://sso.123-reg.co.uk'),
        'nameserver_url' => env('123_REG_NAMESERVER_URL', 'https://www.123-reg.co.uk/cp/domain/nameservers/'),
        'forwarding_url' => env('123_REG_FORWARDING_URL', 'https://www.123-reg.co.uk/secure/cpanel/domain/forwarding/manage/'),
    ],

];
