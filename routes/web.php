<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function(){ return redirect()->route('home'); });
Route::get('/home', function(){ return view('home'); })->name('home');

// Prikaz formi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

// Slanje podataka
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Odjava
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// dashboard rute 
Route::get('/klijent/dashboard', function() {
    return 'Dobrodošao klijent!';
})->name('klijent.dashboard');

Route::get('/stolar/dashboard', function() {
    return 'Dobrodošao stolar!';
})->name('stolar.dashboard');




