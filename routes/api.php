<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthControllerApi;
use App\Http\Controllers\Api\UserProfileController;


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
// Keep existing token route for admin login
Route::post('/token', [AuthControllerApi::class, 'requestToken']);

// Protected routes requiring authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/user-profiles', UserProfileController::class);
});
