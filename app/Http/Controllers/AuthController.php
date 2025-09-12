<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:klijent,stolar'
        ]);

        $credentials = $request->only('email', 'password');
        $role = trim(strtolower($request->input('role')));

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Pogrešan email ili lozinka!'])->withInput();
        }

        if (trim(strtolower($user->role)) !== $role) {
            return back()->withErrors(['role' => 'Pogrešan tip naloga izabran.'])->withInput();
        }

        Auth::login($user);

        return $user->role === 'klijent'
            ? redirect()->route('klijent.dashboard')
            : redirect()->route('stolar.dashboard');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.form');
    }

    public function showRegisterForm()
    {
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        $request->validate([
            'ime' => 'required|string|max:15',
            'prezime' => 'required|string|max:25',
            'email' => 'required|string|email|max:45|unique:users',
            'password' => 'required|string|min:6|confirmed|max:255',
        ]);

        $user = User::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'klijent', // ili 'stolar' po potrebi
        ]);

        // Automatsko logovanje
        Auth::login($user);

        // Preusmeravanje po roli
        if ($user->role === 'klijent') {
            return redirect()->route('klijent.dashboard');
        } else {
            return redirect()->route('stolar.dashboard');
        }
    }

    
}

