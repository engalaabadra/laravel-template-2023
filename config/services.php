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

    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => 'http://127.0.0.1:8000/auth/callback/twitter',
    ],
    // 'moyasar' =>[
    //     'key_test'=>'pk_test_prjsMhcZFXBumsTr2p9LdC29Jw5oP8SmLBKistXH',
    //     'secret_test'=>'sk_test_vf5LXD8TmbwxSo5GnHaPJPxeMAvnEZJcHMYjY1L1',
    //     'key_live'=>'pk_live_EHFhgeVr6yGdFFnrbeuHfMcJQZVMv5sRm7HsjZhd',
    //     'sk_live_JqPqdVwGmwducJKKMrBdWgRbMBYxdizqAwcR1n2w'=>'sk_live_JqPqdVwGmwducJKKMrBdWgRbMBYxdizqAwcR1n2w',
    // ],
    'tap' => [
        'secret' => env('SECRET'),
        'key' => env('KEY')

    ],
    // 'agora' => [
    //     'app_id' => 'def3ecd1518741f393bc5ed1eae29e01',
    //     'app_certificate' => '871bb32479e3409ba6ec112104fc44dc'
    // ],
    'pusher' => [
        'app_id'=>env('PUSHER_APP_ID'),
        'app_key'=>env('PUSHER_APP_KEY'),
        'app_secret'=>env('PUSHER_APP_SECRET'),
        'app_cluster'=>env('PUSHER_APP_CLUSTER'),
    ],
    'firebase' => [
        'server_key'=>env('SERVER_KEY')
    ],
    'twilio' => [
        'account_sid'=>env('ACCOUNT_SID'),
        'auth_token'=>env('AUTH_TOKEN'),
        'twilio_from'=>env('TWILIO_FROM'),
    ],
    'mailers' => [
     'smtp' => [
         'transport' => 'smtp',
         'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
         'port' => env('MAIL_PORT', 2525),
         'encryption' => env('MAIL_ENCRYPTION', null),
         'username' => env('MAIL_USERNAME'),
         'password' => env('MAIL_PASSWORD'),
         'timeout' => null,
         'auth_mode' => null,
     ],
 ],
    'vonage'=>[
        'key'=>env('VONAGE_SID'),
        'pass'=>env('VONAGE_AUTH_TOKEN'),
    ],

    'msegat'=>[
    'username'=>env('MSEGAT_USERNAME'),
    'password'=>env('MSEGAT_PASSWORD'),
]

];
