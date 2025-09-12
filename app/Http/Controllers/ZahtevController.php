<?php

namespace App\Http\Controllers;

use App\Models\Zahtev;
use App\Models\Klijent;
use Illuminate\Http\Request;

class ZahtevController extends Controller
{
    public function index()
    {
        $zahtevi = Zahtev::with('klijent')->get();
        return view('zahtevi.index', compact('zahtevi'));
    }

    public function create()
    {
        $klijenti = Klijent::all();
        return view('zahtevi.create', compact('klijenti'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Vrsta_proizvoda' => 'required|string|max:50',
            'Opis' => 'nullable|string|max:200',
            'Lokacija' => 'required|string|max:100',
            'Telefon' => 'required|string|max:20',
            'Klijent_id' => 'required|exists:Klijent,ID_Klijent',
        ]);

        Zahtev::create($request->all());

        return redirect()->route('zahtevi.index')->with('success', 'Zahtev uspešno kreiran.');
    }

    public function show(Zahtev $zahtev)
    {
        return view('zahtevi.show', compact('zahtev'));
    }

    public function edit(Zahtev $zahtev)
    {
        $klijenti = Klijent::all();
        return view('zahtevi.edit', compact('zahtev','klijenti'));
    }

    public function update(Request $request, Zahtev $zahtev)
    {
        $request->validate([
            'Vrsta_proizvoda' => 'required|string|max:50',
            'Opis' => 'nullable|string|max:200',
            'Lokacija' => 'required|string|max:100',
            'Telefon' => 'required|string|max:20',
            'Klijent_id' => 'required|exists:Klijent,ID_Klijent',
        ]);

        $zahtev->update($request->all());

        return redirect()->route('zahtevi.index')->with('success', 'Zahtev uspešno ažuriran.');
    }

    public function destroy(Zahtev $zahtev)
    {
        $zahtev->delete();
        return redirect()->route('zahtevi.index')->with('success', 'Zahtev obrisan.');
    }
}
