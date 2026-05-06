<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/video-urls', [\App\Http\Controllers\ApiController::class, 'getVideoUrls']);
Route::get('/latest-releases', [\App\Http\Controllers\ApiController::class, 'getLatestReleases']);
