<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    | IMPORTANT:
    | USING CUSTOM AUTHCONTROLLER
    |--------------------------------------------------------------------------
    */

    Route::get(
        'register',
        [AuthController::class, 'showRegister']
    )->name('register');

    Route::post(
        'register',
        [AuthController::class, 'register']
    );

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        'login',
        [AuthController::class, 'showLogin']
    )->name('login');

    Route::post(
        'login',
        [AuthController::class, 'login']
    );

    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get(
        'forgot-password',
        [PasswordResetLinkController::class, 'create']
    )->name('password.request');

    Route::post(
        'forgot-password',
        [PasswordResetLinkController::class, 'store']
    )->name('password.email');

    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get(
        'reset-password/{token}',
        [NewPasswordController::class, 'create']
    )->name('password.reset');

    Route::post(
        'reset-password',
        [NewPasswordController::class, 'store']
    )->name('password.store');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | VERIFY EMAIL
    |--------------------------------------------------------------------------
    */

    Route::get(
        'verify-email',
        EmailVerificationPromptController::class
    )->name('verification.notice');

    Route::get(
        'verify-email/{id}/{hash}',
        VerifyEmailController::class
    )
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post(
        'email/verification-notification',
        [EmailVerificationNotificationController::class, 'store']
    )
        ->middleware('throttle:6,1')
        ->name('verification.send');

    /*
    |--------------------------------------------------------------------------
    | CONFIRM PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get(
        'confirm-password',
        [ConfirmablePasswordController::class, 'show']
    )->name('password.confirm');

    Route::post(
        'confirm-password',
        [ConfirmablePasswordController::class, 'store']
    );

    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::put(
        'password',
        [PasswordController::class, 'update']
    )->name('password.update');

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post(
        'logout',
        [AuthController::class, 'logout']
    )->name('logout');
});
