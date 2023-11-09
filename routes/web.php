<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/student.php';

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [GoogleAuthController::class, 'showTest'])
    ->name('test');

// google sso route
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])
    ->name('google_redirect');
