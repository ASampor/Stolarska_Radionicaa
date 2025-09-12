<?php

namespace App\Http\Controllers;

use App\Models\Narudzbina;
use App\Models\Klijent;
use App\Models\Stolar;
use App\Models\Status;
use Illuminate\Http\Request;

class NarudzbinaController extends Controller
{
    public function index()
    {
        $narudzbine = Narudzbina::with(['klijent','stolar','status'])->get();
        return view('narudzbine.index', compact('narudzbine'));
    }

    public function create()
    {
        $klijenti = Klijent::all();
        $stolari = Stolar::all();
        $statusi = Status::all();
        return view('narudzbine.create', compact('klijenti','stolari','statusi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Specifikacija' => 'nullable|string|max:255',
            'Rok' => 'required|date',
            'Klijent_id' => 'required|exists:Klijent,ID_Klijent',
            'Stolar_id' => 'required|exists:Stolar,ID_Stolar',
            'Cena' => 'required|numeric',
            'Status_id' => 'required|exists:Status,ID_Status',
        ]);

        Narudzbina::create($request->all());

        return redirect()->route('narudzbine.index')->with('success', 'Narudžbina uspešno kreirana.');
    }

    public function show(Narudzbina $narudzbina)
    {
        return view('narudzbine.show', compact('narudzbina'));
    }

    public function edit(Narudzbina $narudzbina)
    {
        $klijenti = Klijent::all();
        $stolari = Stolar::all();
        $statusi = Status::all();
        return view('narudzbine.edit', compact('narudzbina','klijenti','stolari','statusi'));
    }

    public function update(Request $request, Narudzbina $narudzbina)
    {
        $request->validate([
            'Specifikacija' => 'nullable|string|max:255',
            'Rok' => 'required|date',
            'Klijent_id' => 'required|exists:Klijent,ID_Klijent',
            'Stolar_id' => 'required|exists:Stolar,ID_Stolar',
            'Cena' => 'required|numeric',
            'Status_id' => 'required|exists:Status,ID_Status',
        ]);

        $narudzbina->update($request->all());

        return redirect()->route('narudzbine.index')->with('success', 'Narudžbina uspešno ažurirana.');
    }

    public function destroy(Narudzbina $narudzbina)
    {
        $narudzbina->delete();
        return redirect()->route('narudzbine.index')->with('success', 'Narudžbina obrisana.');
    }
}
