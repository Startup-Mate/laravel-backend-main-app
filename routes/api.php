<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatchmakingController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/user/update', [UserController::class, 'update'])->middleware('auth:sanctum');

Route::post('/find-matches', [MatchmakingController::class, 'findMatches'])->middleware('auth:sanctum');

Route::prefix('api/v1')->group(function () {
    Route::get('/subscription', [SubscriptionController::class, 'getSubscription'])->middleware('auth:sanctum');
});