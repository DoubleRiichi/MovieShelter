<?php
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YouTubeController;




Route::get('/', [HomeController::class, 'index']);


Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);

use App\Http\Controllers\RecommendationController;

Route::get('/recommendation-form', [RecommendationController::class, 'showForm'])->name('showForm');
Route::post('/recommend', [RecommendationController::class, 'recommend'])->name('recommend');


//retourne la vue trailer en cliquant sur Recherche
Route::get('/search', function () {
    return redirect('/trailers');
});

Route::get('/Subscription',[RegisterController::class,'showRegistrationForm'])->name('register');;
