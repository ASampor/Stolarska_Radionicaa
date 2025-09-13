@extends('layouts.deashboardstolar')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-brown">🗓 Zakazani sastanci</h1>
        <p class="text-muted">Sastanci sa klijentima</p>
    </div>

    <!-- Forma za dodavanje sastanka -->
    <div class="card mb-5 shadow-sm rounded-4 p-4 border-light">
        <h4 class="mb-3">Dodaj novi sastanak</h4>
        <form action="{{ route('stolar.sastanci.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Zahtev_id" class="form-label">Izaberite zahtev</label>
                <select name="Zahtev_id" id="Zahtev_id" class="form-select" required>
                    <option value="">-- Odaberite zahtev --</option>
                    @foreach($zahtevi as $zahtev)
                        <option value="{{ $zahtev->id }}">
                            {{ $zahtev->id }}. {{ $zahtev->Vrsta_proizvoda }} ({{ \Carbon\Carbon::parse($zahtev->created_at)->format('d.m.Y') }})
                        </option>

                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="Datum_vreme" class="form-label">Datum i vreme</label>
                <input type="datetime-local" name="Datum_vreme" id="Datum_vreme" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark rounded-pill">Zakazi sastanak</button>
        </form>
    </div>

    <h3 class="mb-3">📅 Svi sastanci</h3>
    @if($sastanci->isEmpty())
        <p class="text-muted">Trenutno nema zakazanih sastanaka.</p>
    @else
        <div class="row g-4">
            @foreach($sastanci as $sastanak)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm rounded-4 h-100 border-light p-4">
                        <!-- Dominantno vreme sastanka -->
                        <div class="text-center mb-3">
                            <h2 class="fw-bold text-primary">
                                {{ \Carbon\Carbon::parse($sastanak->Datum_vreme)->format('d.m.Y') }}
                            </h2>
                            <h4 class="fw-semibold text-dark">
                                {{ \Carbon\Carbon::parse($sastanak->Datum_vreme)->format('H:i') }}
                            </h4>
                        </div>

                        <!-- Podaci o klijentu -->
                        <div class="border-top pt-3">
                            <p class="mb-2"><strong>👤 Klijent:</strong> 
                                {{ $sastanak->zahtev->klijent->Ime ?? 'Nepoznat' }}
                                {{ $sastanak->zahtev->klijent->Prezime ?? '' }}
                            </p>
                            <p class="mb-2"><strong>📍 Lokacija:</strong> {{ $sastanak->zahtev->Lokacija ?? 'N/A' }}</p>
                            <p class="mb-0"><strong>📞 Telefon:</strong> {{ $sastanak->zahtev->Telefon ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endif

<style>
.text-brown {
    color: #555;
}
.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}
</style>
@endsection
