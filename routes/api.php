<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AuthControllerApi;
use App\Http\Controllers\Api\BookingCalendarController;
use App\Http\Controllers\Api\CampController;
use App\Http\Controllers\Api\KamarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes for authentication
Route::post('/token', [AuthControllerApi::class, 'requestToken']);
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Resource routes
    Route::apiResource('/admins', AdminAuthController::class);
    Route::apiResource('/camp', CampController::class);
    Route::apiResource('/kamar', KamarController::class);

    // Camp and Kamar relationship routes
    Route::get('/camp/{id}/kamar', [CampController::class, 'getKamar']);
    Route::get('/camp/{id}/kamar-types', [CampController::class, 'getKamarTypes']);

    Route::get('/kamar/types/{campId}', [KamarController::class, 'getTypesByCamp']);
    Route::get('/kamar/by-type/{campId}/{type}', [KamarController::class, 'getByType']);

    // Booking routes
    Route::get('/booking-calendar/kamar/{id}', [BookingCalendarController::class, 'getKamarDetail']);
    Route::get('/booking-calendar/check/{id}', [BookingCalendarController::class, 'checkBookings']); // Add this new route
    Route::apiResource('/booking-calendar', BookingCalendarController::class);
});
