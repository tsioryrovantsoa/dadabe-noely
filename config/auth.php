<?php

use App\Models\Admin;
use App\Models\Child;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" for your
    | application. Children browse the public side of the site, while
    | administrators manage the catalog behind their own guard.
    |
    */

    'defaults' => [
        'guard' => 'child',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Both guards keep their own session key, so signing in as a child never
    | grants access to the administration pages, and the other way around.
    |
    */

    'guards' => [
        'child' => [
            'driver' => 'session',
            'provider' => 'children',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Each guard resolves its accounts from its own Eloquent model and table.
    |
    */

    'providers' => [
        'children' => [
            'driver' => 'eloquent',
            'model' => Child::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | window expires and users are asked to re-enter their password.
    |
    */

    'password_timeout' => 10800,

];
