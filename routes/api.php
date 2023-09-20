<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\API\AuthController;
// use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('/test', [UserController::class, 'index']);
//     Route::controller(AuthController::class)->group(function () {
//         Route::post('/logout', 'logout')->name('logout');
//     });
// });
// // Route::post('/register', [AuthController::class, 'register']);

// Route::controller(AuthController::class)->group(function () {
//     // Route::get('/token', 'getToken')->name('getToken');
//     Route::post('/register', 'register')->name('register');
//     Route::post('/login', 'login')->name('login');
// });

Route::get('/test', function() {
    // dd('test');
    return response()->json([
        'message' => 'Hello World 2!'
    ], 200);
});

Route::apiResources([
    'kecamatans' => 'App\Http\Controllers\KecamatansController',
    'kelurahans' => 'App\Http\Controllers\KelurahansController',
    'laporans' => 'App\Http\Controllers\LaporansController',
]);
