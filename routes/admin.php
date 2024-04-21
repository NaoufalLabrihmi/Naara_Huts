<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\HutController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\HutListController;
use App\Http\Controllers\Backend\HutTypeController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Backend\TestimonialController;



Route::middleware(['auth', 'can:dashboard'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});

Route::middleware(['auth'])->group(function () {

    //team all Route
    Route::controller(TeamController::class)->middleware('can:team')->group(function () {
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
    });

    //Book Area all Route
    Route::controller(BookController::class)->middleware('can:bookarea')->group(function () {
        Route::get('/book/area', 'BookArea')->name('book.area');
        Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update');
    });

    Route::middleware(['can:huts'])->group(function () {
        //HutType all Route
        Route::controller(HutTypeController::class)->group(function () {
            Route::get('/hut/type/list', 'HutTypeList')->name('hut.type.list');
            Route::get('/add/hut/type', 'AddHutType')->name('add.hut.type');
            Route::post('/hut/type/store', 'HutTypeStore')->name('hut.type.store');
        });

        //Hut all Route
        Route::controller(HutController::class)->group(function () {
            Route::get('/edit/hut/{id}', 'EditHut')->name('edit.hut');
            Route::get('/delete/hut/{id}', 'DeleteHut')->name('delete.hut');

            Route::post('/update/hut/{id}', 'UpdateHut')->name('update.hut');
            Route::post('/delete/image', 'Delete')->name('delete.image');
            Route::post('/store/hut/no/{id}', 'StoreHutNumber')->name('store.hut.no');
            Route::get('/edit/hutno/{id}', 'EditHutNumber')->name('edit.hutno');
            Route::post('/update/hutno/{id}', 'UpdateHutNumber')->name('update.hutno');
            Route::get('/delete/hutno/{id}', 'DeleteHutNumber')->name('delete.hutno');
        });
    });
    /// Admin Booking All Route
    Route::controller(BookingController::class)->middleware('can:booking')->group(function () {

        Route::get('/booking/list', 'BookingList')->name('booking.list');
        Route::get('/edit_booking/{id}', 'EditBooking')->name('edit_booking');
        Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');
    });

    /// Admin Room List All Route
    Route::controller(HutListController::class)->middleware('can:hutlist')->group(function () {
        Route::get('/view/hut/list', 'ViewHutList')->name('view.hut.list');
        Route::get('/add/hut/list', 'AddHutList')->name('add.hut.list');
        Route::post('/store/hutlist', 'StoreHutList')->name('store.hutlist');
    });


    Route::middleware(['can:setting'])->group(function () {
        //setting email route
        Route::controller(SettingController::class)->group(function () {
            Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting');
            Route::post('/smtp/update', 'SmtpUpdate')->name('smtp.update');
        });
        /// Site Setting All Route
        Route::controller(SettingController::class)->group(function () {
            Route::get('/site/setting', 'SiteSetting')->name('site.setting');
            Route::post('/site/update', 'SiteUpdate')->name('site.update');
        });
    });
    /// Tesimonial All Route
    Route::controller(TestimonialController::class)->middleware('can:tesimonial')->group(function () {

        Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial');
        Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial');
        Route::post('/store/testimonial', 'StoreTestimonial')->name('testimonial.store');
        Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
        Route::post('/update/testimonial', 'UpdateTestimonial')->name('testimonial.update');
        Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
    });

    /// Booking Report All Route
    Route::middleware(['can:report'])->group(function () {
        Route::controller(ReportController::class)->group(function () {
            Route::get('/booking/report/', 'BookingReport')->name('booking.report');
            Route::post('/search-by-date', 'SearchByDate')->name('search-by-date');
        });
    });



    /// Gallery All Route
    Route::controller(GalleryController::class)->middleware('can:gallery')->group(function () {

        Route::get('/all/gallery', 'AllGallery')->name('all.gallery');
        Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
        Route::post('/store/gallery', 'StoreGallery')->name('store.gallery');
        Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
        Route::post('/update/gallery', 'UpdateGallery')->name('update.gallery');
        Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');
        Route::post('/delete/gallery/multiple', 'DeleteGalleryMultiple')->name('delete.gallery.multiple');
    });
    // contact message admin view
    Route::get('/contact/message', [GalleryController::class, 'AdminContactMessage'])->middleware('can:contact')->name('contact.message');
    /// Notification All Route
    Route::controller(BookingController::class)->group(function () {

        Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');
    });

    //roles
    Route::controller(RolesController::class)->middleware('can:roles')->group(function () {

        Route::get('/roles', 'Index')->name('roles.index');
        Route::get('/roles/create', 'Create')->name('roles.create');
        Route::post('/roles/store', 'Store')->name('roles.store');
        Route::get('/roles/edit/{id}', 'Edit')->name('roles.edit');
        Route::post('/roles/update/{id}', 'Update')->name('roles.update');
    });
});
