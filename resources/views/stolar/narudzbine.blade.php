@extends('layouts.deashboardstolar')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-brown">📦 Narudžbine</h1>
        <button type="button" class="btn btn-dark rounded-pill mb-3" data-bs-toggle="modal" data-bs-target="#dodajNarudzbinuModal">
            Dodaj novu narudžbinu
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($narudzbine as $narudzbina)
        <div class="col-md-6">
            <div class="card shadow-sm rounded-4 p-3 h-100 border-light">
                <h5>{{ $narudzbina->Vrsta_proizvoda }}</h5>
                <p><strong>Specifikacija:</strong> {{ $narudzbina->Specifikacija }}</p>
                <p><strong>Rok:</strong> {{ \Carbon\Carbon::parse($narudzbina->Rok)->format('d.m.Y') }}</p>
                <p><strong>Klijent:</strong> {{ $narudzbina->klijent->Ime ?? '' }} {{ $narudzbina->klijent->Prezime ?? '' }}</p>
                <p><strong>Cena:</strong> {{ $narudzbina->Cena }} RSD</p>
                <p><strong>Status:</strong> {{ $narudzbina->status->Naziv ?? 'Nepoznato' }}</p>

                <!-- Dugme za otvaranje modal-a za izmenu -->
                <button type="button" class="btn btn-outline-secondary mt-2" data-bs-toggle="modal" data-bs-target="#editNarudzbinaModal{{ $narudzbina->ID_Narudzbina }}">
                    Izmeni
                </button>
            </div>
        </div>
        @empty
            <p class="text-muted">Trenutno nema narudžbina.</p>
        @endforelse
    </div>
</div>

<!-- Modal za dodavanje nove narudžbine -->
<div class="modal fade" id="dodajNarudzbinuModal" tabindex="-1" aria-labelledby="dodajNarudzbinuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="{{ route('stolar.narudzbine.store') }}">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="dodajNarudzbinuLabel">Nova narudžbina</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="Specifikacija" class="form-label">Specifikacija</label>
                    <textarea class="form-control" id="Specifikacija" name="Specifikacija" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="Rok" class="form-label">Rok</label>
                    <input type="date" class="form-control" id="Rok" name="Rok" required>
                </div>

                <div class="mb-3">
                    <label for="Klijent_id" class="form-label">Klijent</label>
                    <select name="Klijent_id" id="Klijent_id" class="form-select" required>
                        <option value="">-- Izaberite klijenta --</option>
                        @foreach($klijenti as $klijent)
                            <option value="{{ $klijent->ID_Klijent }}">
                                {{ $klijent->Ime }} {{ $klijent->Prezime }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Status_id" class="form-label">Status</label>
                    <select name="Status_id" id="Status_id" class="form-select" required>
                        <option value="">-- Izaberite status --</option>
                        @foreach($statusi as $status)
                            <option value="{{ $status->ID_Status }}">{{ $status->Naziv }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Vrsta_proizvoda" class="form-label">Vrsta proizvoda</label>
                    <input type="text" class="form-control" id="Vrsta_proizvoda" name="Vrsta_proizvoda" required>
                </div>

                <div class="mb-3">
                    <label for="Cena" class="form-label">Cena</label>
                    <input type="number" class="form-control" id="Cena" name="Cena" required>
                </div>

                <input type="hidden" name="Stolar_id" value="{{ Auth::user()->ID_Stolar }}">
            </div>

            <div class="modal-footer justify-content-start">
                <button type="submit" class="btn btn-primary me-2" style="flex: 2;">Sačuvaj narudžbinu</button>
                <button type="button" class="btn btn-secondary" style="flex: 1;" data-bs-dismiss="modal">Otkaži</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal za izmenu narudžbine -->
@foreach($narudzbine as $narudzbina)
<div class="modal fade" id="editNarudzbinaModal{{ $narudzbina->ID_Narudzbina }}" tabindex="-1" aria-labelledby="editNarudzbinaLabel{{ $narudzbina->ID_Narudzbina }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('stolar.narudzbine.update', $narudzbina->ID_Narudzbina) }}">
                @csrf
                @method('PUT') 
                <div class="modal-header">
                    <h5 class="modal-title" id="editNarudzbinaLabel{{ $narudzbina->ID_Narudzbina }}">Izmeni narudžbinu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Klijent</label>
                        <input type="text" class="form-control" value="{{ $narudzbina->klijent->Ime }} {{ $narudzbina->klijent->Prezime }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Specifikacija</label>
                        <textarea class="form-control" disabled>{{ $narudzbina->Specifikacija }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Vrsta_proizvoda{{ $narudzbina->ID_Narudzbina }}" class="form-label">Vrsta proizvoda</label>
                        <input type="text" class="form-control" id="Vrsta_proizvoda{{ $narudzbina->ID_Narudzbina }}" name="Vrsta_proizvoda" value="{{ $narudzbina->Vrsta_proizvoda }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Rok{{ $narudzbina->ID_Narudzbina }}" class="form-label">Rok</label>
                        <input type="date" class="form-control" id="Rok{{ $narudzbina->ID_Narudzbina }}" name="Rok" value="{{ \Carbon\Carbon::parse($narudzbina->Rok)->format('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Status_id{{ $narudzbina->ID_Narudzbina }}" class="form-label">Status</label>
                        <select name="Status_id" id="Status_id{{ $narudzbina->ID_Narudzbina }}" class="form-select" required>
                            @foreach($statusi as $status)
                                <option value="{{ $status->ID_Status }}" @if($status->ID_Status == $narudzbina->Status_id) selected @endif>{{ $status->Naziv }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Cena{{ $narudzbina->ID_Narudzbina }}" class="form-label">Cena</label>
                        <input type="number" class="form-control" id="Cena{{ $narudzbina->ID_Narudzbina }}" name="Cena" value="{{ $narudzbina->Cena }}" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="submit" class="btn btn-primary me-2">Sačuvaj izmene</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Otkaži</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<style>
.text-brown { color: #555; }
.card { transition: all 0.3s ease; }
.card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); }
</style>
@endsection
