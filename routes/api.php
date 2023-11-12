<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\LoginCheck;
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
    Route::post('register', [ApiAuthController::class, 'register'])->middleware('login_check');

    Route::post('login', [ApiAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->prefix('user')->group(
        function () {
            Route::post('register', [ApiAuthController::class, 'register'])->middleware(LoginCheck::class);
            // the user who has been can not register , need to logout first (just preventing when join with UI)

            Route::apiResource('book', BookController::class);
            Route::apiResource('rating', RatingController::class);
            Route::apiResource('review', ReviewController::class);
            Route::post('feedback', [FeedbackController::class, 'store']);
        }
    );
});
