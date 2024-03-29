<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Forum\ForumController;
use App\Http\Controllers\Account\AuthController;
use App\Http\Controllers\Account\RegisterController;

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

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::prefix('auth')->group(function () {
        Route::post('register', [RegisterController::class, 'register']);

        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });

    Route::apiResources([
        'forums' => ForumController::class,
    ]);
});
