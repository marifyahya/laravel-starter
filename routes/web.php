<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomizeThemeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteIdentityController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);
Route::redirect('/logout', url('/'));
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'index']);

    Route::group(['prefix' => 'menu', 'middleware' => 'page.access:menu'], function () {
        Route::get('/', [MenuController::class, 'index'])->name('menu');
        Route::get('table', [MenuController::class, 'table']);
        Route::get('create', [MenuController::class, 'create']);
        Route::post('create', [MenuController::class, 'store']);
        Route::get('/{id}', [MenuController::class, 'edit']);
        Route::put('/{id}', [MenuController::class, 'update']);
        Route::delete('/{id}', [MenuController::class, 'destroy']);
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission');
        Route::get('table', [PermissionController::class, 'table']);
        Route::get('create', [PermissionController::class, 'create']);
        Route::post('create', [PermissionController::class, 'store']);
        Route::get('/{id}', [PermissionController::class, 'edit']);
        Route::put('/{id}', [PermissionController::class, 'update']);
        Route::delete('/{id}', [PermissionController::class, 'destroy']);
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role');
        Route::get('table', [RoleController::class, 'table']);
        Route::get('create', [RoleController::class, 'create']);
        Route::post('create', [RoleController::class, 'store']);
        Route::get('/{id}', [RoleController::class, 'edit']);
        Route::put('/{id}', [RoleController::class, 'update']);
        Route::delete('/{id}', [RoleController::class, 'destroy']);
    });

    Route::group(['prefix' => 'customize-theme'], function () {
        Route::get('/', [CustomizeThemeController::class, 'index']);
        Route::post('/', [CustomizeThemeController::class, 'setThemes']);
        Route::delete('/', [CustomizeThemeController::class, 'resetThemes']);
    });

    Route::group(['prefix' => 'site-identity'], function () {
        Route::get('/', [SiteIdentityController::class, 'index']);
        Route::post('/', [SiteIdentityController::class, 'update']);
    });

    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employee');
        Route::get('table', [EmployeeController::class, 'table']);
        Route::get('create', [EmployeeController::class, 'create']);
        Route::post('create', [EmployeeController::class, 'store']);
        Route::get('/{id}', [EmployeeController::class, 'edit']);
        Route::put('/{id}', [EmployeeController::class, 'update']);
        Route::delete('/{id}', [EmployeeController::class, 'destroy']);
    });
});
