<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to("/login")
        ->with('message', ['type' => 'success', 'text' => 'You have successfully logged out']);
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', function () {
    })->name('dashboard');

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('user-dashboard');
    Route::get('/admin-dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin-dashboard');

    Route::get('/vars', function(){

        // \App\Models\User::factory()->count(20)->create();

        dd(123);
    });
});

require __DIR__.'/auth.php';
