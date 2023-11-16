<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
})->name('home');

// login routes
Route::get('/login',[LoginController::class,'loginForm'])->name('login.form');
Route::post('/login',[LoginController::class,'authenticate'])->name('login.auth');

// register routes
Route::get('/register',[RegisterController::class,'registerForm'])->name('register.form');
Route::post('/register',[RegisterController::class,'register'])->name('register.validate');

// logout routes
Route::post('/logout',[LoginController::class,'logout'])->name('Logout');