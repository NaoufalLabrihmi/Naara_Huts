<?php

use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Frontend\BookingController;
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

Route::middleware(['auth'])->group(function () {
    //Check out all route
    Route::controller(BookingController::class)->group(function () {
        Route::get('/checkout/', 'Checkout')->name('checkout');
        Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');
        Route::post('/checkout/store/', 'CheckoutStore')->name('checkout.store');
        Route::match(['get', 'post'], '/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');
        // booking Update
        Route::post('/update/booking/status/{id}', 'UpdateBookingStatus')->name('update.booking.status');
        Route::post('/update/booking/{id}', 'UpdateBooking')->name('update.booking');
        // Assign Hut Route
        Route::get('/assign_hut/{id}', 'AssignHut')->name('assign_hut');
        Route::get('/assign_hut/store/{booking_id}/{hut_number_id}', 'AssignHutStore')->name('assign_hut_store');
        Route::get('/assign_hut_delete/{id}', 'AssignHutDelete')->name('assign_hut_delete');

        ////////// User Booking Route
        Route::get('/user/booking', 'UserBooking')->name('user.booking');
        Route::get('/user/invoice/{id}', 'UserInvoice')->name('user.invoice');
    });
});

Route::controller(GalleryController::class)->group(function () {
    Route::get('/gallery', 'ShowGallery')->name('show.gallery');

    // Contact All Route
    Route::get('/contact', 'ContactUs')->name('contact.us');
    Route::post('/store/contact', 'StoreContactUs')->name('store.contact');
});



//// adminn
