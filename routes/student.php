<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


Route::get('/student', [StudentController::class, 'showIndex'])
    ->name('student_home');