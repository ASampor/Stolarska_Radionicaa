<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Zahtev;
use App\Models\Sastanak;
use App\Models\Narudzbina;
use App\Models\Stolar;
use App\Models\Status;
use App\Models\Klijent;

class StolarController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $zahtevi = Zahtev::all();
        return view('stolar.dashboard', compact('zahtevi'));
    }

   public function sastanci()
    {
        $user = Auth::user();
        $stolar = Stolar::where('Email', $user->email)->first();
        $stolarId = $stolar->ID_Stolar;

        $sastanci = Sastanak::where('Stolar_id', $stolarId)
                            ->orderBy('Datum_vreme', 'asc')
                            ->get();

        $zahtevi = Zahtev::all();
        return view('stolar.sastanci', compact('sastanci', 'zahtevi'));
    }

    public function storeSastanak(Request $request)
    {
        $request->validate([
            'Zahtev_id' => 'required|exists:zahtevi,ID_Zahtev',
            'Datum_vreme' => 'required|date|after:now',
        ]);

        $user = Auth::user();
        $stolar = Stolar::where('Email', $user->email)->first();
        $stolarId = $stolar->ID_Stolar;

        Sastanak::create([
            'Zahtev_id' => $request->Zahtev_id,
            'Stolar_id' => $stolarId,
            'Datum_vreme' => $request->Datum_vreme,
        ]);

        return redirect()->route('stolar.sastanci')->with('success', 'Sastanak uspešno zakazan!');
    }


    public function narudzbine()
    {
        $user = Auth::user();
        $stolar = Stolar::where('Email', $user->email)->first();

        if (!$stolar) {
            return redirect()->back()->with('error', 'Nije pronađen stolar.');
        }

        $stolarId = $stolar->ID_Stolar;

        $narudzbine = Narudzbina::where('Stolar_id', $stolarId)
                                ->with(['klijent', 'status'])
                                ->orderBy('Rok', 'asc')
                                ->get();

        $klijenti = Klijent::all();
        $statusi = Status::all();

        return view('stolar.narudzbine', compact('narudzbine', 'klijenti', 'statusi'));
    }

    // Edit stranica (više ti ne treba jer koristimo modal)
    public function editNarudzbina($id)
    {
        $narudzbina = Narudzbina::findOrFail($id);
        $klijenti = Klijent::all();
        $statusi = Status::all();

        return view('stolar.edit-narudzbina', compact('narudzbina', 'klijenti', 'statusi'));
    }

    // Čuvanje nove narudžbine
    public function storeNarudzbina(Request $request)
    {
        $request->validate([
            'Specifikacija' => 'required|string',
            'Rok' => 'required|date',
            'Klijent_id' => 'required|exists:klijent,ID_Klijent',
            'Status_id' => 'required|exists:status,ID_Status',
            'Vrsta_proizvoda' => 'required|string',
            'Cena' => 'required|numeric',
        ]);

        $user = Auth::user();
        $stolar = Stolar::where('Email', $user->email)->firstOrFail();

        Narudzbina::create([
            'Specifikacija' => $request->Specifikacija,
            'Rok' => $request->Rok,
            'Klijent_id' => $request->Klijent_id,
            'Stolar_id' => $stolar->ID_Stolar,
            'Status_id' => $request->Status_id,
            'Vrsta_proizvoda' => $request->Vrsta_proizvoda,
            'Cena' => $request->Cena,
        ]);

        return redirect()->route('stolar.narudzbine')->with('success', 'Narudžbina uspešno dodata!');
    }

    // Izmena postojeće narudžbine
    public function updateNarudzbina(Request $request, $id)
    {
        $request->validate([
            'Vrsta_proizvoda' => 'required|string',
            'Rok' => 'required|date',
            'Status_id' => 'required|exists:status,ID_Status',
            'Cena' => 'required|numeric',
        ]);

        $narudzbina = Narudzbina::findOrFail($id);

        $narudzbina->update([
            'Vrsta_proizvoda' => $request->Vrsta_proizvoda,
            'Rok' => $request->Rok,
            'Status_id' => $request->Status_id,
            'Cena' => $request->Cena,
        ]);

        return redirect()->route('stolar.narudzbine')->with('success', 'Narudžbina uspešno izmenjena!');
    }
}
