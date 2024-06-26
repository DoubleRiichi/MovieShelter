<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MovieDetailsController;
use App\Http\Controllers\YouTubeController;




Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);

//retourne la vue trailer en cliquant sur Recherche
Route::get('/search', function () {
    return redirect('/trailers');
});

Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register',[RegisterController::class,'register'])->name('register');

Route::get('/login', [LoginController::class, "show"])->name("login");
Route::post('/login', [LoginController::class, "login"])->name("login");

Route::get("/logout", [LoginController::class, "logout"])->name("logout");

Route::get('auth/google', [RegisterController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);


Route::get("/movie/{movie_id}", [MovieDetailsController::class, "show"]);
Route::post("/movie/{movie_id}", [MovieDetailsController::class, "writeComment"]);


Route::get("/list/{user_id}", [ListingController::class, "show"]);
