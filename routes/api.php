<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserMediaController;

Route::apiResource('media', MediaController::class);

// Relasi User dan Media
Route::post('/users/{user}/media/{medium}', [UserMediaController::class, 'attach']);
Route::get('/users/{user}/media', [UserMediaController::class, 'index']);
Route::delete('/users/{user}/media/{medium}', [UserMediaController::class, 'detach']);
