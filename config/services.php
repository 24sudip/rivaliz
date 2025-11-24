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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // 'google' => [
    //     'client_id' => '974388653082-qkeatrjnab9pv7o8260hn28ivptrk3dc.apps.googleusercontent.com',
    //     'client_secret' => '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',
    //     'redirect' => 'https://easylearning.deshii.com.bd/google/callback',
    // ],
    
    'google' => [
        'client_id' => '328661798683-apotrm3igttue9mm2frlmqj08m0u6er4.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://learnengwithshahan.com/google/callback',
    ],
];
