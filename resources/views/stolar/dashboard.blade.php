@extends('layouts.deashboardstolar')

@php
    $user = auth()->user();
@endphp

@section('content')
<div class="container py-5">
    <!-- Naslov i opis -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-brown">📋 Svi zahtevi</h1>
        <p class="text-muted">Ovde možete pratiti sve zahteve koje su poslali klijenti.</p>
    </div>

    @if($zahtevi->isEmpty())
        <p class="text-muted text-center">Trenutno nema poslataih zahteva.</p>
    @else
        <div class="row g-4">
            @foreach($zahtevi as $zahtev)
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-4 h-100 border-light">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <!-- Vrsta proizvoda -->
                            <div class="vrsta-proizvoda mb-3">
                                {{ $zahtev->id }}. {{ $zahtev->Vrsta_proizvoda }}
                            </div>

                            <!-- Opis -->
                            <p class="text-muted mb-2"><strong>📝 Opis:</strong> {{ Str::limit($zahtev->Opis ?? 'Nema opisa', 80) }}</p>

                            <!-- Lokacija -->
                            <p class="mb-1"><strong>📍 Lokacija:</strong> {{ $zahtev->Lokacija }}</p>

                            <!-- Telefon -->
                            <p class="mb-1"><strong>📞 Telefon:</strong> {{ $zahtev->Telefon }}</p>

                            <!-- Checkbox Zakazano -->
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="zakazano-{{ $zahtev->ID_Zahtev }}" {{ $zahtev->Zakazano ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="zakazano-{{ $zahtev->ID_Zahtev }}">
                                    📌 Zakazano
                                </label>
                            </div>

                            <!-- Datum slanja -->
                            <p class="text-end text-secondary mt-3" style="font-size:0.85rem;">
                                Poslat: {{ \Carbon\Carbon::parse($zahtev->created_at)->format('d.m.Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.text-brown {
    color: #555; /* topla braon boja */
}
.vrsta-proizvoda {
    font-size: 1.2rem;
    font-weight: 600;
    color: #555;
    background: #f0f0f0;
    padding: 10px 15px;
    border-radius: 10px;
    text-align: center;
}
.card {
    transition: all 0.3s ease;
    border: 1px solid #f1e3d3;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}
.form-check-label {
    cursor: pointer;
}
</style>
@endsection
