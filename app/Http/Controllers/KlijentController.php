<?php

namespace App\Http\Controllers;

use App\Models\Klijent;
use App\Models\Zahtev;
use App\Models\Narudzbina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KlijentController extends Controller
{
    public function index()
    {
        $klijenti = Klijent::all();
        return view('klijenti.index', compact('klijenti'));
    }

    public function create()
    {
        return view('klijenti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Ime' => 'required|string|max:50',
            'Prezime' => 'required|string|max:50',
            'Email' => 'required|email|unique:Klijent,Email',
            'Lozinka' => 'required|string|min:6',
        ]);

        Klijent::create([
            'Ime' => $request->Ime,
            'Prezime' => $request->Prezime,
            'Email' => $request->Email,
            'Lozinka' => Hash::make($request->Lozinka),
        ]);

        return redirect()->route('klijenti.index')->with('success', 'Klijent dodat.');
    }

    public function show(Klijent $klijent)
    {
        return view('klijenti.show', compact('klijent'));
    }

    public function edit(Klijent $klijent)
    {
        return view('klijenti.edit', compact('klijent'));
    }

    public function update(Request $request, Klijent $klijent)
    {
        $request->validate([
            'Ime' => 'required|string|max:50',
            'Prezime' => 'required|string|max:50',
            'Email' => 'required|email|unique:Klijent,Email,' . $klijent->ID_Klijent . ',ID_Klijent',
        ]);

        $data = $request->only(['Ime','Prezime','Email']);
        if ($request->filled('Lozinka')) {
            $data['Lozinka'] = Hash::make($request->Lozinka);
        }

        $klijent->update($data);

        return redirect()->route('klijenti.index')->with('success', 'Klijent ažuriran.');
    }

    public function destroy(Klijent $klijent)
    {
        $klijent->delete();
        return redirect()->route('klijenti.index')->with('success', 'Klijent obrisan.');
    }

    // Dashboard
    public function dashboard()
    {
        $user = Auth::user(); // Laravel user
        return view('klijent.dashboard', compact('user'));
    }

    // Prikaz svih zahteva
    public function zahtevi()
    {
        $user = Auth::user();
        $zahtevi = Zahtev::where('Klijent_id', $user->id)
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('klijent.zahtevi', compact('zahtevi'));
    }

    public function pregled()
    {
        $user = Auth::user();

        $zahtevi = Zahtev::where('Klijent_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

        $narudzbine = Narudzbina::where('Klijent_id', $user->id)
        ->get();

        return view('klijent.pregled', compact('zahtevi', 'narudzbine'));
    }
}
