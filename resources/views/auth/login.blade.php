@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg rounded-4">
            <div class="card-body p-4" style="background-color: #f8fafc; border-radius: 15px;">
                <h3 class="text-center mb-3">Prijava</h3>
                <p class="text-center text-muted">Prijavite se na vaš nalog</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control rounded-pill" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Lozinka</label>
                        <input type="password" id="password" name="password" class="form-control rounded-pill" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 rounded-pill">Prijavite se</button>
                </form>

                <p class="text-center mt-3">
                    Nemate nalog? <a href="{{ route('register.form') }}">Registrujte se</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
