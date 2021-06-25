<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group( function() {
    // Filepond routes
    Route::prefix('blueadmin/filepond')->group(function () {
        Route::post('/', [Ndeblauw\BlueAdmin\Http\Controllers\FilepondController::class, 'upload'])->name('filepond.upload');
        Route::delete('/', [Ndeblauw\BlueAdmin\Http\Controllers\FilepondController::class, 'delete'])->name('filepond.delete');
    });

    // Login as routes
    Route::get('admin/login-as/stop', [Ndeblauw\BlueAdmin\Http\Controllers\UserLoginAsController::class, 'stopLoginAs'])->name('stoploginas');
    Route::get('admin/login-as/{user}', [Ndeblauw\BlueAdmin\Http\Controllers\UserLoginAsController::class, 'loginAs'])/*->middleware('isadmin')*/->name('loginas');

});

