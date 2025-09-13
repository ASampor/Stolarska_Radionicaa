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
    Route::get('/stolar/sastanci', [StolarController::class, 'sastanci'])->name('stolar.sastanci');
    Route::post('/stolar/sastanci/store', [StolarController::class, 'storeSastanak'])->name('stolar.sastanci.store');
    Route::get('/stolar/narudzbine', [StolarController::class, 'narudzbine'])->name('stolar.narudzbine');
    Route::get('/stolar/narudzbine/{id}/edit', [StolarController::class, 'editNarudzbina'])
    ->name('stolar.narudzbine.edit');
    Route::put('/stolar/narudzbine/{id}', [StolarController::class, 'updateNarudzbina'])->name('stolar.narudzbine.update');
    Route::post('/stolar/narudzbine/store', [StolarController::class, 'storeNarudzbina'])->name('stolar.narudzbine.store');

});
