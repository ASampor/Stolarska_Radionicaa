<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KlijentController;
use App\Http\Controllers\StolarController;
use App\Http\Controllers\ZahtevController;

// HOME
Route::get('/', fn() => redirect()->route('home'));
Route::get('/home', fn() => view('home'))->name('home');

// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// SVE OSTALO → iza auth middleware-a
Route::middleware(['auth'])->group(function () {
    // klijent
    Route::get('/klijent/dashboard', [KlijentController::class, 'dashboard'])->name('klijent.dashboard');
    Route::get('/klijent/pregled', [KlijentController::class, 'pregled'])->name('klijent.pregled');
    Route::post('/klijent/zahtev', [ZahtevController::class, 'store'])->name('klijent.zahtev.store');

    // stolar
    Route::get('/stolar/dashboard', [StolarController::class, 'dashboard'])->name('stolar.dashboard');
    Route::get('/stolar/zahtevi', [StolarController::class, 'zahtevi'])->name('stolar.zahtevi');
    Route::get('/stolar/termini', [StolarController::class, 'termini'])->name('stolar.termini');
    Route::post('/stolar/termini/store', [StolarController::class, 'storeTermin'])->name('stolar.termini.store');
    Route::get('/stolar/narudzbine', [StolarController::class, 'narudzbine'])->name('stolar.narudzbine');
});
