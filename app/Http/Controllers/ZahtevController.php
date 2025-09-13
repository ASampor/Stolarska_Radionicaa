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
            'Telefon' => 'required|string|max:50',
            'Klijent_id' => 'required|integer|exists:users,id',
        ]);

        $zahtev = new Zahtev();
        $zahtev->Vrsta_proizvoda = $request->Vrsta_proizvoda;
        $zahtev->Opis = $request->Opis;
        $zahtev->Lokacija = $request->Lokacija;
        $zahtev->Telefon = $request->Telefon;
        $zahtev->Klijent_id = $request->Klijent_id;
        $zahtev->save();

        return redirect()->route('klijent.dashboard')->with('success', 'Zahtev je uspešno poslat!');
    }
}
