<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;

require_once __DIR__ . '/utils.php';


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

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
});

// disini cek routing

Route::group(['middleware' => ['auth:sanctum', 'ability:superadmin,admin']], function () {
    Route::apiResources(createRoutes());
});

Route::group(['middleware' => ['auth:sanctum', 'ability:superadmin']], function () {
    Route::apiResources(createRouteNoAdmin());
});

Route::group(['middleware' => ['auth:sanctum', 'ability:superadmin,admin']], function () {
    Route::apiResources(createRouteNoAdmin(), ['only' => ['show', 'update']]);
});
