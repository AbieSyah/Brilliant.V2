<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAplikasiController;
use App\Http\Controllers\Api\KamarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// UserAolikasi routes
Route::post('register', [UserAplikasiController::class, 'register']);
Route::post('login', [UserAplikasiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserAplikasiController::class, 'getProfile']);
    Route::post('logout', [UserAplikasiController::class, 'logout']);
    Route::put('profile/update', [UserAplikasiController::class, 'updateProfile']);
});

// Kamar routes - all public routes
Route::get('kamar', [KamarController::class, 'index']);
Route::get('kamar/{id}', [KamarController::class, 'show']);

// Kamar routes - Protected routes for admin operations
Route::middleware('auth:sanctum')->group(function () {
    Route::post('kamar', [KamarController::class, 'store']);
    Route::put('kamar/{id}', [KamarController::class, 'update']);
    Route::delete('kamar/{id}', [KamarController::class, 'destroy']);
});
