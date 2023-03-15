<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return redirect('/');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::group(['prefix' => 'user'], function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('data', 'index')->name('users');
        Route::get('create', 'create')->name('create-user');
        Route::post('create', 'store');
        Route::get('{id}/edit', 'edit')->name('edit-user');
        Route::post('{id}/edit', 'update');
    });
});

Route::group(['prefix' => 'setting'], function() {
    Route::controller(SettingController::class)->group(function () {
        Route::get('data', 'index')->name('settings');
        Route::put('update', 'update')->name('update-settings');
    });
});
