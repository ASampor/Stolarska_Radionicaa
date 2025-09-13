@extends('layouts.deashboardstolar')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-brown">🗓 Zakazani termini</h1>
        <p class="text-muted">Termini sastanka sa klijentima</p>
    </div>

    <!-- Forma za dodavanje termina -->
    <div class="card mb-5 shadow-sm rounded-4 p-4 border-light">
        <h4 class="mb-3">Dodaj novi termin</h4>
        <form action="{{ route('stolar.termini.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Zahtev_id" class="form-label">Izaberite zahtev</label>
                <select name="Zahtev_id" id="Zahtev_id" class="form-select" required>
                    <option value="">-- Odaberite zahtev --</option>
                    @foreach($zahtevi as $zahtev)
                        <option value="{{ $zahtev->ID_Zahtev }}">
                            {{ $zahtev->id}}. {{ $zahtev->Vrsta_proizvoda }} ({{ \Carbon\Carbon::parse($zahtev->created_at)->format('d.m.Y') }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="Datum_vreme" class="form-label">Datum i vreme</label>
                <input type="datetime-local" name="Datum_vreme" id="Datum_vreme" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark rounded-pill">Zakazi termin</button>
        </form>
    </div>

    <!-- Prikaz svih termina -->
    <h3 class="mb-3">📅 Svi termini</h3>
    @if($termini->isEmpty())
        <p class="text-muted">Trenutno nema zakazanih termina.</p>
    @else
        <div class="row g-4">
            @foreach($termini as $termin)
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-4 h-100 border-light p-3">
                        <h5 class="mb-2">{{ $termin->zahtev->Vrsta_proizvoda ?? 'Nepoznato' }}</h5>
                        <p class="text-muted mb-1"><strong>📍 Lokacija:</strong> {{ $termin->zahtev->Lokacija ?? 'N/A' }}</p>
                        <p class="text-muted mb-1"><strong>📞 Telefon:</strong> {{ $termin->zahtev->Telefon ?? 'N/A' }}</p>
                        <p class="text-muted"><strong>🗓 Datum i vreme:</strong> {{ \Carbon\Carbon::parse($termin->Datum_vreme)->format('d.m.Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

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
