<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/video-urls', [\App\Http\Controllers\ApiController::class, 'getVideoUrls']);
Route::get('/latest-releases', [\App\Http\Controllers\ApiController::class, 'getLatestReleases']);

// Frontend APIs
Route::get('/featured-categories', [\App\Http\Controllers\Api\FrontendController::class, 'featuredCategories']);
Route::get('/top-writers', [\App\Http\Controllers\Api\FrontendController::class, 'topWriters']);
Route::get('/editors-picks', [\App\Http\Controllers\Api\FrontendController::class, 'editorsPicks']);
Route::get('/posts', [\App\Http\Controllers\Api\FrontendController::class, 'posts']);
Route::get('/categories', [\App\Http\Controllers\Api\FrontendController::class, 'categories']);
Route::get('/creators', [\App\Http\Controllers\Api\FrontendController::class, 'creators']);
Route::get('/clients', [\App\Http\Controllers\Api\FrontendController::class, 'clients']);
Route::get('/reporters', [\App\Http\Controllers\Api\FrontendController::class, 'reporters']);
Route::get('/reporter-persons', [\App\Http\Controllers\Api\FrontendController::class, 'reporterPersons']);
Route::get('/global-config', [\App\Http\Controllers\Api\FrontendController::class, 'globalConfig']);

// Admin APIs (No Sanctum auth based on user feedback to just apply modules)
Route::prefix('admin')->group(function () {
    Route::apiResource('categories', \App\Http\Controllers\Api\Admin\CategoryController::class);
    Route::apiResource('creators', \App\Http\Controllers\Api\Admin\CreatorController::class);
    Route::apiResource('posts', \App\Http\Controllers\Api\Admin\PostController::class);
});
