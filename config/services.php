<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1704540486536006',
        'client_secret' => 'a5b4a29c85afe91d9637cadce6348bb5',
        'redirect' => 'http://playwithme.app/callback/facebook',
    ],

    'twitter' => [
        'client_id' => 'JDVFPahf6o90ccCc0vApzLQPJ',
        'client_secret' => '3fQLuYPG2F4lv6mTuWelBAh1W5eCUkylsUqfwi1ZPusQDNstah',
        'redirect' => 'http://playwithme.app/callback/twitter',
    ],
];
