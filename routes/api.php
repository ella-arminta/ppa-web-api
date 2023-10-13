<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\LaporansController;

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

Route::get('/', function () {
    return response()->json([
        'message' => 'Connection Success!',
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/testing', function () {
    return response()->json([
        'message' => 'Hello World!',
    ]);
});

// disini cek routing

Route::middleware(['cors'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
    });
    
    Route::group(['middleware' => ['auth:sanctum', 'ability:superadmin,admin']], function () {
        Route::get('/statuses/count', 'App\Http\Controllers\StatusesController@getCountKasus');
        Route::apiResources(createRoutes());
    });
    
    // Route::group(['middleware' => ['auth:sanctum', 'ability:superadmin']], function () {
    //     Route::apiResources(createRouteNoAdmin());
    // });
    
    // Route::group(['middleware' => ['auth:sanctum', 'ability:superadmin,admin']], function () {
    //     Route::apiResources(createRouteNoAdmin(), ['only' => ['show', 'update']]);
    // });
});


// Route::apiResources(createRoutes());
