@extends('layouts.deashboard')
@php
    $user = auth()->user();
@endphp

@section('content')
<div class="text-center">
    <img src="{{ asset('images/kuchinja.jpg') }}" 
         class="img-fluid rounded mb-4" 
         style="max-height:400px; object-fit:cover; width:100%;" 
         alt="Wood Design">

    <h1 class="fw-bold mb-3">Wood Design Cicka</h1>
    <p class="lead">
        Naš informacioni sistem omogućava vam da brzo 
        <br>i jednostavno pošaljete zahtev za izradu nameštaja po meri i pratite status vaše narudžbine na jednom mestu.
    </p>

    <!-- Dugme za otvaranje modala -->
    <a href="#" class="btn btn-dark mt-3" data-bs-toggle="modal" data-bs-target="#dodajZahtevModal">
        Pošaljite zahtev za proizvod
    </a>

    <!-- Modal za dodavanje zahteva -->
    <div class="modal fade" id="dodajZahtevModal" tabindex="-1" aria-labelledby="dodajZahtevLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="{{ route('klijent.zahtev.store') }}">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="dodajZahtevLabel">Novi zahtev</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-start">
                        <label for="Vrsta_proizvoda" class="form-label">Vrsta proizvoda</label>
                    </div>
                    <input type="text" class="form-control" id="Vrsta_proizvoda" name="Vrsta_proizvoda" required>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-start">
                        <label for="Opis" class="form-label">Opis</label>
                    </div>
                    <textarea class="form-control" id="Opis" name="Opis"></textarea>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-start">
                        <label for="Lokacija" class="form-label">Lokacija</label>
                    </div>
                    <input type="text" class="form-control" id="Lokacija" name="Lokacija" required>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-start">
                        <label for="Telefon" class="form-label">Telefon</label>
                    </div>
                    <input type="text" class="form-control" id="Telefon" name="Telefon" required>
                </div>

                <!-- Automatski klijent ID -->
                <input type="hidden" name="Klijent_id" value="{{ $user->id }}">
            </div>

            <div class="modal-footer justify-content-start">
                <button type="submit" class="btn btn-primary me-2" style="flex: 2;">Pošalji zahtev</button>
                <button type="button" class="btn btn-secondary" style="flex: 1;" data-bs-dismiss="modal">Otkaži</button>
            </div>
        </form>
        </div>
    </div>
    </div>

</div>

<div class="row text-center mt-5">
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h3>✅ Kvalitet</h3>
            <p>Koristimo samo najkvalitetniji materijal i tehniku.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h3>⚡ Brzina</h3>
            <p>Poštujemo rokove i brzo završavamo projekte.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h3>👷‍♂️ Iskustvo</h3>
            <p>Godine iskustva garantuju profesionalnu uslugu.</p>
        </div>
    </div>
</div>

<div class="mt-5 text-center">
    <h2>Naše usluge</h2>
    <p>Nudimo širok spektar stolarijskih usluga prilagođenih vašim potrebama</p>
    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
        <span class="btn btn-outline-secondary">Kuhinje po meri</span>
        <span class="btn btn-outline-secondary">Spavaće sobe</span>
        <span class="btn btn-outline-secondary">Dnevni boravci</span>
        <span class="btn btn-outline-secondary">Garderoberi</span>
        <span class="btn btn-outline-secondary">Kancelarijski nameštaj</span>
        <span class="btn btn-outline-secondary">Vrata i prozori</span>
        <span class="btn btn-outline-secondary">Baštenski nameštaj</span>
        <span class="btn btn-outline-secondary">Posebni zahtevi</span>
    </div>
</div>
@endsection
