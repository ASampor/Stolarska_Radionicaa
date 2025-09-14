<?php

namespace App\Http\Controllers;

use App\Models\Sastanak;
use App\Models\Zahtev;
use App\Models\Stolar;
use Illuminate\Http\Request;

class TerminController extends Controller
{
    public function index()
    {
        $termini = Sastanak::with(['zahtev','stolar'])->get();
        return view('termini.index', compact('termini'));
    }

    public function create()
    {
        $zahtevi = Zahtev::all();
        $stolari = Stolar::all();
        return view('termini.create', compact('zahtevi','stolari'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Datum_vreme' => 'required|date',
            'Zahtev_id' => 'required|exists:Zahtev,ID_Zahtev',
            'Stolar_id' => 'required|exists:Stolar,ID_Stolar',
        ]);

        Sastanak::create($request->all());

        return redirect()->route('termini.index')->with('success', 'Termin uspešno zakazan.');
    }

    public function show(Sastanak $termin)
    {
        return view('termini.show', compact('termin'));
    }

    public function edit(Sastanak $termin)
    {
        $zahtevi = Zahtev::all();
        $stolari = Stolar::all();
        return view('termini.edit', compact('termin','zahtevi','stolari'));
    }

    public function update(Request $request, Sastanak $termin)
    {
        $request->validate([
            'Datum_vreme' => 'required|date',
            'Zahtev_id' => 'required|exists:Zahtev,ID_Zahtev',
            'Stolar_id' => 'required|exists:Stolar,ID_Stolar',
        ]);

        $termin->update($request->all());

        return redirect()->route('termini.index')->with('success', 'Termin uspešno ažuriran.');
    }

    public function destroy(Sastanak $termin)
    {
        $termin->delete();
        return redirect()->route('termini.index')->with('success', 'Termin obrisan.');
    }
}
