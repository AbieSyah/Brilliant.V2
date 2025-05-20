<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AuthControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes for authentication
Route::post('/token', [AuthControllerApi::class, 'requestToken']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Your other protected resources here
    Route::apiResource('/admins', AdminAuthController::class);
});

Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});
