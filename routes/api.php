<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AuthControllerApi;
use App\Http\Controllers\Api\BookingCalendarController;
use App\Http\Controllers\Api\KamarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes for authentication
Route::post('/token', [AuthControllerApi::class, 'requestToken']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Route::post('/token', [AuthControllerApi::class, 'requestToken']);
    // Protected resources using apiResource
    Route::apiResource('/admins', AdminAuthController::class);
    Route::apiResource('/kamar', KamarController::class);
    Route::apiResource('/booking-calendar', BookingCalendarController::class);
});

Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});
