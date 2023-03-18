<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PermissionController;

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
        Route::get('{user}/show', 'show')->name('show-user');
        Route::get('{id}/edit', 'edit')->name('edit-user');
        Route::put('{id}/edit', 'update');
        Route::delete('{id}/delete','destroy')->name('delete-user');
        Route::get('{user}/assign-role', 'assign_roles')->name('assign-roles');
        Route::post('{user}/assign-role', 'assign_roles_store');
    });
});

// User Roles routes
Route::group(['prefix' => 'user/role'], function() {
    Route::controller(RoleController::class)->group(function () {
        Route::get('data', 'index')->name('roles');
        Route::get('create', 'create')->name('create-role');
        Route::post('create', 'store');
        Route::get('{role}/show', 'show')->name('show-role');
        Route::get('{role}/edit', 'edit')->name('edit-role');
        Route::put('{role}/edit', 'update');
        Route::delete('{role}/delete','destroy')->name('delete-role');
        Route::get('{role}/assign-permissions', 'assign_permissions')->name('assign-permissions');
        Route::post('{role}/assign-permissions', 'assign_permissions_store');
    });
});

// User Permission routes
Route::group(['prefix' => 'user/permission'], function() {
    Route::controller(PermissionController::class)->group(function () {
        Route::get('data', 'index')->name('permissions');
        Route::get('create', 'create')->name('create-permission');
        Route::post('create', 'store');
        Route::get('{permission}/edit', 'edit')->name('edit-permission');
        Route::put('{permission}/edit', 'update');
        Route::delete('{permission}/delete','destroy')->name('delete-permission');
    });
});

Route::group(['prefix' => 'setting'], function() {
    Route::controller(SettingController::class)->group(function () {
        Route::get('data', 'index')->name('settings');
        Route::put('update', 'update')->name('update-settings');
    });
});
