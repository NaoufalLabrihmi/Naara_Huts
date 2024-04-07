<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\HutTypeController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\HutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;



Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});

Route::middleware(['auth', 'roles:admin'])->group(function () {

    //team all Route
    Route::controller(TeamController::class)->group(function () {
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
    });

    //Book Area all Route
    Route::controller(BookController::class)->group(function () {
        Route::get('/book/area', 'BookArea')->name('book.area');
        Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update');
    });

    //HutType all Route
    Route::controller(HutTypeController::class)->group(function () {
        Route::get('/hut/type/list', 'HutTypeList')->name('hut.type.list');
        Route::get('/add/hut/type', 'AddHutType')->name('add.hut.type');
        Route::post('/hut/type/store', 'HutTypeStore')->name('hut.type.store');
    });

    //Hut all Route
    Route::controller(HutController::class)->group(function () {
        Route::get('/edit/hut/{id}', 'EditHut')->name('edit.hut');
    });
});
