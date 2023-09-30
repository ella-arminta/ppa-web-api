<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

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

// Route::get('/hello', function () {
//     return 'welcome';
// });
Route::get('/test', function() {
    // dd('test');
    return response()->json([
        'message' => 'Hello World!'
    ], 200);
});

// Route::get('/test', [Controller::class, 'test']);

// Route::controller(AuthController::class)->group(function() {
//     Route::get('/token', 'getToken')->name('getToken');
//     Route::post('/register', 'register')->name('register');
//     Route::post('/login', 'login')->name('login');
// });
