<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get(
    '/movies/search/{movieTitle}',
    [\App\Http\Controllers\MovieController::class, 'search']
)->middleware('auth:sanctum');

Route::get(
    '/movies/{movieId}',
    [\App\Http\Controllers\MovieController::class, 'getMovieDetails']
)->middleware('auth:sanctum');

Route::post(
    '/movies/vote/{movieId}',
    [\App\Http\Controllers\MovieController::class, 'vote']
)->middleware('auth:sanctum');
