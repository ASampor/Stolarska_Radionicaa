@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg rounded-4">
            <div class="card-body p-4" style="background-color: #f8fafc; border-radius: 15px;">
                <h3 class="text-center mb-3">Prijava</h3>
                <p class="text-center text-muted">Prijavite se na vaš nalog</p>

                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <input type="hidden" name="role" id="role" value="klijent">

                    <div class="d-flex justify-content-center mb-3">
                        <button type="button" id="btn-klijent" class="btn btn-primary me-2 rounded-pill">Klijent</button>
                        <button type="button" id="btn-stolar" class="btn btn-outline-primary rounded-pill">Stolar</button>
                    </div>

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


                {{-- Link za registraciju --}}
                <p class="text-center mt-3" id="register-link">
                    Nemate nalog? <a href="{{ route('register.form') }}">Registrujte se</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    const roleInput = document.getElementById('role');
    const btnKlijent = document.getElementById('btn-klijent');
    const btnStolar = document.getElementById('btn-stolar');
    const form = document.getElementById('login-form');

    form.addEventListener('submit', e => {
        if (!roleInput.value) {
            e.preventDefault();
            alert("Molimo izaberite ulogu pre prijave!");
        }
    });

    btnKlijent.addEventListener('click', () => {
        roleInput.value = 'klijent';
        btnKlijent.classList.add('btn-primary');
        btnKlijent.classList.remove('btn-outline-primary');
        btnStolar.classList.add('btn-outline-primary');
        btnStolar.classList.remove('btn-primary');
    });

    btnStolar.addEventListener('click', () => {
        roleInput.value = 'stolar';
        btnStolar.classList.add('btn-primary');
        btnStolar.classList.remove('btn-outline-primary');
        btnKlijent.classList.add('btn-outline-primary');
        btnKlijent.classList.remove('btn-primary');
    });
</script>
@endsection
