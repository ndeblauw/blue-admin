<?php

namespace Ndeblauw\BlueAdmin;

class BlueAdmin
{
    public static function routes()
    {
        // Filepond routes
        Route::prefix('filepond')->group(function () {
            Route::post('/', [App\Http\Controllers\BlueAdmin\FilepondController::class, 'upload'])->name('filepond.upload');
            Route::delete('/', [App\Http\Controllers\BlueAdmin\FilepondController::class, 'delete'])->name('filepond.delete');
        });

// Login as routes
        Route::get('admin/login-as/stop', [\App\Http\Controllers\BlueAdmin\UserLoginAsController::class, 'stopLoginAs'])->name('stoploginas');
        Route::get('admin/login-as/{user}', [\App\Http\Controllers\BlueAdmin\UserLoginAsController::class, 'loginAs'])/*->middleware('isadmin')*/->name('loginas');

    }
}
