<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login.index');
Route::post('/', [AuthController::class, 'auth'])->name('login.auth');

Route::prefix('/role')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/', [RoleController::class, 'store'])->name('role.store');
    Route::get('/{id}', [RoleController::class, 'show'])->name('role.show');
    Route::put('/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});

Route::prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::prefix('/{id}/change-password')->group(function () {
        Route::get('/', [UserController::class, 'changePassword'])->name('user.change-password.index');
        Route::patch('/', [UserController::class, 'updatePassword'])->name('user.change-password.patch');
    });
});
