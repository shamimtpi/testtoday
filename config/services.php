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
     'stripe' => [
	'model' => Responsive\User::class,
	'key' => env('STRIPE_KEY'),
	'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
	'client_id' => env('FB_APP_ID'),
	'client_secret' => env('FB_APP_SECRET'),
	'redirect' => env('FB_CALLBACK_URL'),
    ],
    'twitter' => [
	'client_id'      => env('TW_APP_ID'),
	'client_secret'  => env('TW_APP_SECRET'),
	'redirect'       => env('TW_CALLBACK_URL'),
    ],
    'google' => [ 
        'client_id'      => env('GOOG_APP_ID'),
        'client_secret' => env('GOOG_APP_SECRET'),
        'redirect'      => env('GOOG_CALLBACK_URL'), 
    ],

];