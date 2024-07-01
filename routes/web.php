<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//login routes 


Route::controller(LoginController::class)->group(function(){
    //google
    Route::get('login/google/','redirectGoogle')->name('login.google');
    Route::get('login/google/callback','redirectGoogleCallback');

    //facebook
    Route::get('login/facebook/','redirectFacebook')->name('login.facebook');
    Route::get('login/facebook/callback','redirectFacebookCallback');

    //github
    Route::get('login/github/','redirectGithub')->name('login.github');
    Route::get('login/github/callback','redirectGithubCallback');

});
