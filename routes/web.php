<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\YouTubeController;

Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);

use App\Http\Controllers\RecommendationController;

Route::get('/recommendation-form', [RecommendationController::class, 'showForm'])->name('showForm');
Route::post('/recommend', [RecommendationController::class, 'recommend'])->name('recommend');




