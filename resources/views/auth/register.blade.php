@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height:80vh;">
    <div class="card shadow p-4" style="max-width: 450px; width: 100%; border-radius: 12px;">
        <h2 class="text-center mb-4">Registracija</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="ime" class="form-label">Ime</label>
                <input type="text" class="form-control" id="ime" name="ime" required>
            </div>

            <div class="mb-3">
                <label for="prezime" class="form-label">Prezime</label>
                <input type="text" class="form-control" id="prezime" name="prezime" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Lozinka</label>
                <input type="password" class="form-control" id="lozinka" name="lozinka" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Ponovite lozinku</label>
                <input type="password" class="form-control" id="lozinka_confirmation" name="lozinka_confirmation" required>
            </div>

            <button type="submit" class="btn btn-dark w-100">Registruj se</button>

            <div class="text-center mt-3">
                <small>Imate već nalog? <a href="{{ route('login.form') }}">Prijavite se</a></small>
            </div>
        </form>
    </div>
</div>
@endsection
