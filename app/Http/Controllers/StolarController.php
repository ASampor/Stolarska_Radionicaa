<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Zahtev;
use App\Models\Termin;
use App\Models\Narudzbina;

class StolarController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $zahtevi = Zahtev::all();
        return view('stolar.dashboard', compact('zahtevi'));
    }

    // Prikaz svih termina
    public function termini()
    {
        $user = Auth::user();
        $stolarId = $user->id; // koristi Laravel primarni ključ

        $termini = Termin::where('Stolar_id', $stolarId)
                          ->orderBy('Datum_vreme', 'asc')
                          ->get();

        $zahtevi = Zahtev::all();

        return view('stolar.termini', compact('termini', 'zahtevi'));
    }

    // Čuvanje novog termina
    public function storeTermin(Request $request)
    {
        $request->validate([
            'Zahtev_id' => 'required|exists:Zahtev,ID_Zahtev',
            'Datum_vreme' => 'required|date|after:now',
        ]);

        $user = Auth::user();
        $stolarId = $user->id; // Laravel primarni ključ

        Termin::create([
            'Zahtev_id' => $request->Zahtev_id,
            'Stolar_id' => $stolarId,
            'Datum_vreme' => $request->Datum_vreme,
        ]);

        return redirect()->route('stolar.termini')->with('success', 'Termin uspešno zakazan!');
    }

    // Prikaz svih narudžbina
    public function narudzbine()
    {
        $narudzbine = Narudzbina::with('status')->orderBy('Datum_kreiranja', 'desc')->get();
        return view('stolar.narudzbine', compact('narudzbine'));
    }
}
