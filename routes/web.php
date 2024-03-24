<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/** hover show */
function hover_show($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'hover show' : '';
    }
    return Request::path() == $route ? 'hover show' : '';
}

/** for side bar menu active */
// function set_active($route)
// {
//     if (is_array($route)) {
//         return in_array(Request::path(), $route) ? 'active' : '';
//     }
//     return Request::path() == $route ? 'active' : '';
// }

Route::get('/', function () {
    return view('home');
});

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('home', function () {
//         return view('home');
//     });
//     Route::get('home', function () {
//         return view('home');
//     });
// });

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
