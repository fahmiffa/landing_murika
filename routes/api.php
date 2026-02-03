<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => 'auth:api'
], function ($router) {
    Route::apiResource('employees', EmployeeController::class);
    Route::get('presensi/history', [\App\Http\Controllers\Api\PresensiController::class, 'history']);
    Route::post('presensi/qr', [\App\Http\Controllers\Api\PresensiController::class, 'storeFromQr']);
});
