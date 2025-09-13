<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Klijent;
use App\Models\Stolar;

class AuthController extends Controller
{
    // Prikaz forme za login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login metoda
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Pogrešan email ili lozinka!'])->withInput();
        }

        Auth::login($user);

        // Svaki mejl koji ZAVRŠAVA na @wooddesign → stolar
        $isStolar = str_ends_with(strtolower($user->email), '@wooddesign');

        return $isStolar
            ? redirect()->route('stolar.dashboard')
            : redirect()->route('klijent.dashboard');
    }

    // Logout
     public function logout(Request $request)
    {
        Auth::logout();

        // Obriši sesiju i regeneriši CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    // Prikaz forme za registraciju
    public function showRegisterForm()
    {
        return view('auth.register'); 
    }

    // Registracija klijenta
    public function register(Request $request)
{
    $request->validate([
        'ime' => 'required|string|max:15',
        'prezime' => 'required|string|max:25',
        'email' => 'required|string|email|max:45|unique:users,email',
        'lozinka' => 'required|string|min:6|confirmed|max:255',
    ]);

    $user = DB::transaction(function() use ($request) {
        // Prvo ubaci u Klijent tabelu
        $klijent = Klijent::create([
            'Ime' => $request->ime,
            'Prezime' => $request->prezime,
            'Email' => $request->email,
            'Lozinka' => Hash::make($request->lozinka),
        ]);

        // Zatim ubaci u Users tabelu
        return User::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'email' => $request->email,
            'password' => Hash::make($request->lozinka),
            'role' => 'klijent',
        ]);
    });

    Auth::login($user);

    return redirect()->route('klijent.dashboard');
}


}
