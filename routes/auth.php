<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;



Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    // ----------------------------login ------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login/push', 'authenticate')->name('login/push');
        Route::get('/logout', 'logout')->name('logout');
        Route::post('change/password', 'changePassword')->name('change/password');
    });

    // ------------------------ register sccount ----------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('register/form', 'index')->name('register/form');
        Route::post('register/save', 'saveRecord')->name('register/save');
    });

    // -------------------------- forgot password ---------------------//
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/forgot/password', 'sendEmail')->name('forgot/password');
        Route::post('post/email', 'postEmail')->name('post/email');
    });

    // ------------------------- reset password -----------------------//
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset/password/{token}', 'getPassword');
        Route::post('reset/password', 'updatePassword')->name('reset/password');
    });

    // ------------------------ confirm password -----------------------//
    Route::controller(ConfirmPasswordController::class)->group(function () {
        Route::get('confirm/password', 'confirmPassword')->name('confirm/password');
    });
});
