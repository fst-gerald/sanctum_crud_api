<?php

use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;

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

Route::post('/auth/token', [LoginController::class, 'getSanctumTokenFromCredentials']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/auth/logout', [LogoutController::class, 'logout']);

    Route::prefix('users')->group(function() {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::apiResource('contents', ContentController::class);
});

// TODO: make this secure
Route::post('/mail/sendSimple', [MailController::class, 'sendSimpleEmail']);
