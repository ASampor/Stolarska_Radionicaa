<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StolarController extends Controller
{
    // Funkcija za dashboard stolara
    public function dashboard()
    {
        return view('stolar.dashboard'); 
    }
}
