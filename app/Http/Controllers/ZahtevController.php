<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zahtev;

class ZahtevController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'Vrsta_proizvoda' => 'required|string|max:255',
            'Opis' => 'nullable|string',
            'Lokacija' => 'required|string|max:255',
            'Telefon' => 'required|string|max:20',
            'Klijent_id' => 'required|exists:users,id'
        ]);

        // Kreiramo novi zahtev
        Zahtev::create([
            'Vrsta_proizvoda' => $request->Vrsta_proizvoda,
            'Opis' => $request->Opis,
            'Lokacija' => $request->Lokacija,
            'Telefon' => $request->Telefon,
            'Klijent_id' => $request->Klijent_id
        ]);

        return redirect()->route('klijent.dashboard')->with('success', 'Zahtev uspešno dodat!');
    }
}
