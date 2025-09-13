<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KlijentController;
use App\Http\Controllers\StolarController;
use App\Http\Controllers\ZahtevController;

// -------------------------------------------------
// HOME
// -------------------------------------------------
Route::get('/', function(){ return redirect()->route('home'); });
Route::get('/home', function(){ return view('home'); })->name('home');

// -------------------------------------------------
// AUTH (login, register, logout)
// -------------------------------------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -------------------------------------------------
// KLijent DASHBOARD
// -------------------------------------------------
//Route::middleware(['auth'])->group(function () {
    //Route::get('/klijent/dashboard', [KlijentController::class, 'dashboard'])
      //  ->name('klijent.dashboard');
//});

Route::middleware(['auth'])->group(function () {
    Route::get('/stolar/dashboard', [StolarController::class, 'dashboard'])->name('stolar.dashboard');
    Route::get('/klijent/dashboard', [KlijentController::class, 'dashboard'])->name('klijent.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/klijent/zahtevi', [ZahtevController::class, 'index'])->name('klijent.zahtevi.index');
    Route::get('/klijent/zahtev/create', [ZahtevController::class, 'create'])->name('klijent.zahtev.create');
    Route::post('/klijent/zahtev', [ZahtevController::class, 'store'])->name('klijent.zahtev.store');
    Route::get('/klijent/zahtev/{zahtev}/edit', [ZahtevController::class, 'edit'])->name('klijent.zahtev.edit');
    Route::put('/klijent/zahtev/{zahtev}', [ZahtevController::class, 'update'])->name('klijent.zahtev.update');
    Route::delete('/klijent/zahtev/{zahtev}', [ZahtevController::class, 'destroy'])->name('klijent.zahtev.destroy');
});

Route::middleware(['auth'])->prefix('klijent')->name('klijent.')->group(function() {
    Route::post('/zahtev/store', [App\Http\Controllers\ZahtevController::class, 'store'])->name('zahtev.store');
});

Route::middleware(['auth'])->prefix('klijent')->name('klijent.')->group(function() {
    Route::get('/moji-zahtevi', [ZahtevController::class, 'mojiZahtevi'])->name('moji.zahtevi');
});

