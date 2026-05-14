<?php

use App\Models\User;
use App\Models\Admin;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'resident',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [

        // RESIDENT LOGIN
        'resident' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // BARANGAY WORKER LOGIN
        'worker' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // ADMIN LOGIN
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [

        // USERS TABLE
        'users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ],

        // ADMINS TABLE
        'admins' => [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [

        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];
