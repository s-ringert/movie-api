<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get(
    '/movies/search/{movieTitle}',
    [\App\Http\Controllers\MovieController::class, 'search']
);
