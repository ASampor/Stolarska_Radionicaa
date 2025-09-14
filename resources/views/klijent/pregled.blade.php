@extends('layouts.deashboard')

@php
    $user = auth()->user();
@endphp

@section('content')
<div class="container py-5">
    <!-- Naslov i opis -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-brown">Moji zahtevi i narudžbine</h1>
        <p class="text-muted">Ovde možete pratiti sve vaše zahteve i narudžbine na jednom mestu.</p>
    </div>

    <!-- MOJI ZAHTEVI -->
    <h3 class="mb-3">📋 Moji zahtevi</h3>
    @if($zahtevi->isEmpty())
        <p class="text-muted">Trenutno nemate poslatih zahteva.</p>
    @else
        <div class="row g-4 mb-5">
            @foreach($zahtevi as $zahtev)
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-4 h-100 border-light">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="vrsta-proizvoda mb-3">
                                {{ $zahtev->Vrsta_proizvoda }}
                            </div>
                            <p class="text-muted mb-2">{{ Str::limit($zahtev->Opis ?? 'Nema opisa', 80) }}</p>
                            <p class="mb-1"><strong>📍 Lokacija:</strong> {{ $zahtev->Lokacija }}</p>
                            <p class="mb-1"><strong>📞 Telefon:</strong> {{ $zahtev->Telefon }}</p>
                            <p class="text-end text-secondary mt-3" style="font-size:0.85rem;">
                                Poslat: {{ \Carbon\Carbon::parse($zahtev->created_at)->format('d.m.Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- MOJE NARUDŽBINE -->
    <h3 class="mb-3">🛒 Moje narudžbine</h3>
    @if($narudzbine->isEmpty())
        <p class="text-muted">Trenutno nemate kreiranih narudžbina.</p>
    @else
    <div class="row g-4">
        @foreach($narudzbine as $narudzbina)
            <div class="col-md-4">
                <div class="card shadow-sm rounded-4 h-100 border-light">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="vrsta-proizvoda mb-3">
                            {{ $narudzbina->Vrsta_proizvoda }}
                        </div>
                        <p class="mb-1"><strong>🗓 Rok:</strong> {{ \Carbon\Carbon::parse($narudzbina->Rok)->format('d.m.Y') }}</p>
                        <p class="mb-1"><strong>💰 Cena:</strong> {{ number_format($narudzbina->Cena, 2, ',', '.') }} RSD</p>
                        <p class="mb-1"><strong>📌 Status:</strong> 
                            <span class="badge {{ $narudzbina->status->Naziv === 'Završeno' ? 'bg-success' : ($narudzbina->status->Naziv === 'U toku' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                {{ $narudzbina->status->Naziv ?? 'Nepoznato' }}
                            </span>
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
        color: #555; 
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
</style>
@endsection
