<?php

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

Route::group([
    'prefix' => 'user',
    'middleware' => 'api'
], function ($router) {
    $router->post('login', [\App\Http\Controllers\Api\UsersController::class, 'login']);
    $router->post('register', [\App\Http\Controllers\Api\UsersController::class, 'register']);
});

Route::group([
    'prefix' => 'user',
    'middleware' => 'auth:api'
], function ($router) {
    $router->post('otpVerify', [\App\Http\Controllers\Api\UsersController::class, 'otpVerify']);
    $router->post('otpResend', [\App\Http\Controllers\Api\UsersController::class, 'otpResend']);
    $router->post('subscription/create', [\App\Http\Controllers\Api\SubscriptionController::class, 'store']);
});
