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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('regisapi', [App\Http\Controllers\Auth\RegisAPIController::class, 'register']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Auth\AuthController::class, 'refresh']);
    Route::get('me', [App\Http\Controllers\Auth\AuthController::class, 'me']);
});

Route::group([
    'middleware' => ['auth:api'],
], function ($router) {

    Route::get('permit-all', [App\Http\Controllers\User\PermitController::class, 'index']);
    Route::post('create-permit', [App\Http\Controllers\Employee\PermitController::class, 'store']);
    Route::put('update-permit/{id}', [App\Http\Controllers\Employee\PermitController::class, 'update']);
    Route::get('permit-detail/{id}', [App\Http\Controllers\Employee\PermitController::class, 'permit_detail']);
});