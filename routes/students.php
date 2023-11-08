<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [StudentController::class, 'showLogin'])
    ->name('student_showlogin');
