<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function () {
    Route::post('register', [ApiAuthController::class, 'register']);

    Route::post('login', [ApiAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->prefix('user')->group(
        function () {
            Route::apiResource('book', BookController::class);
            Route::apiResource('rating', RatingController::class);
            Route::apiResource('review', ReviewController::class);
        }
    );
});
