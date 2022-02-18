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

Route::post('/register', [\App\Http\Controllers\Auth\ApiAuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Auth\ApiAuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('classes', \App\Http\Controllers\ClassesController::class);
    Route::resource('roles', \App\Http\Controllers\RoleController::class);

    Route::get('notifications/unread', [\App\Http\Controllers\NotificationController::class, 'unread']);
    Route::get('notifications/all', [\App\Http\Controllers\NotificationController::class, 'all']);
    Route::put('notifications/{id}/markAsRead', [\App\Http\Controllers\NotificationController::class, 'markAsRead']);
    Route::delete('notifications/{id}/delete', [\App\Http\Controllers\NotificationController::class, 'destroy']);

    Route::post('/logout', [\App\Http\Controllers\Auth\ApiAuthController::class, 'logout']);
});
