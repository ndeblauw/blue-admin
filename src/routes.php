<?php

use Illuminate\Support\Facades\Route;
use Ndeblauw\BlueAdmin\BlueAdminController;

Route::middleware('web')->group( function() {
    // Filepond routes
    Route::prefix('blueadmin/filepond')->group(function () {
        Route::post('/', [Ndeblauw\BlueAdmin\Http\Controllers\FilepondController::class, 'upload'])->name('filepond.upload');
        Route::delete('/', [Ndeblauw\BlueAdmin\Http\Controllers\FilepondController::class, 'delete'])->name('filepond.delete');
    });
    
    // Tinymce image upload
    Route::post('blueadmin/tinymce/upload', Ndeblauw\BlueAdmin\Http\Controllers\TinymceImageUploadController::class)->name('tinymce.upload');

    // Login as routes
    Route::get('admin/login-as/stop', [Ndeblauw\BlueAdmin\Http\Controllers\UserLoginAsController::class, 'stopLoginAs'])->name('stoploginas');
    Route::get('admin/login-as/{user}', [Ndeblauw\BlueAdmin\Http\Controllers\UserLoginAsController::class, 'loginAs'])/*->middleware('isadmin')*/->name('loginas');

    Route::get('admin/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('admin.logout');

    // API index
    Route::get('blueadmin/api/v1/{modelname}', Ndeblauw\BlueAdmin\Http\Controllers\ApiIndexController::class)->name('blueadmin.api.index');

    // Auxiliary routes for blueadmin functionality
    Route::get('blueadmin/toggle-statesave/{modelname}/', [Ndeblauw\BlueAdmin\Http\Controllers\BlueAdminController::class, 'toggleStateSave'])->name('blueadmin.index.toggle-statesave');
    Route::get('blueadmin/toggle-show-delete/{modelname}/', [Ndeblauw\BlueAdmin\Http\Controllers\BlueAdminController::class, 'toggleShowDelete'])->name('blueadmin.index.toggle-show-delete');
    Route::get('blueadmin/toggle-open-new-window/{modelname}', [Ndeblauw\BlueAdmin\Http\Controllers\BlueAdminController::class, 'toggleOpenNewWindow'])->name('blueadmin.index.toggle-open-new-window');
});

