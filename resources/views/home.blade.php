@extends('layouts.app')

@section('content')
<div class="text-center">
    <img src="{{ asset('images/kuchinja.jpg') }}" 
         class="img-fluid rounded mb-4" 
         style="max-height:400px; object-fit:cover; width:100%;" 
         alt="Wood Design">

    <h1 class="fw-bold mb-3">Wood Design Cicka</h1>
    <p class="lead">Naš informacioni sistem omogućava vam da brzo 
        <br>i jednostavno pošaljete zahtev za izradu nameštaja po meri i pratite status vaše narudžbine na jednom mestu.</p>

    <a href="{{ route('login.form') }}" class="btn btn-dark mt-3">
        Pošalji zahtev za proizvod
    </a>
    
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
