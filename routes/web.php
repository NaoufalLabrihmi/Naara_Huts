<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\FrontendHutController;

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

Route::get('/', [UserController::class, 'Index']);

/** for side bar menu active */
// function set_active($route)
// {
//     if (is_array($route)) {
//         return in_array(Request::path(), $route) ? 'active' : '';
//     }
//     return Request::path() == $route ? 'active' : '';
// }

// Route::get('/', function () {
//     return view('home');
// })->name('home');


// Route::group(['middleware' => 'auth'], function () {
//     Route::get('home', function () {
//         return view('home');
//     });
//     Route::get('home', function () {
//         return view('home');
//     });
// });

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('password/change/store', [UserController::class, 'ChangePasswordStore'])->name('password.change.store');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::controller(FrontendHutController::class)->group(function () {
    Route::get('/huts', 'AllFrontendHutList')->name('froom.all');
    Route::get('/hut/details/{id}', 'HutDetailsPage');
    Route::get('/booking/', 'BookingSearch')->name('booking.search');
    Route::get('/search/hut/details/{id}', 'SearchHutDetails')->name('search_hut_details');
    Route::get('/check_hut_availability/', 'ChekHutAvailability')->name('check_hut_availability');
});


//// adminn
