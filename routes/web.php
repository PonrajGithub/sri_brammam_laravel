<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('video-urls', \App\Http\Controllers\VideoUrlController::class);
        Route::resource('latest-releases', \App\Http\Controllers\LatestReleaseController::class);
        
        Route::resource('categories', \App\Http\Controllers\CategoryController::class);
        Route::resource('creators', \App\Http\Controllers\CreatorController::class);
        Route::resource('posts', \App\Http\Controllers\PostController::class);
        Route::resource('clients', \App\Http\Controllers\ClientController::class);
        Route::resource('reporters', \App\Http\Controllers\ReporterController::class);
        Route::resource('reporter-persons', \App\Http\Controllers\ReporterPersonController::class);
    });
});
