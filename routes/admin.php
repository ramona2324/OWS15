<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// test route only
Route::get('/test', [AdminController::class, 'showTest'])
    ->name('test');

// all admin routes here
Route::group(['prefix' => 'admin'], function () {
    Route::get('/signup', [AdminController::class, 'showSignup1'])
        ->name('admin_signup1');
});
