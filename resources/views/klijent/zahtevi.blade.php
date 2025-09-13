@extends('layouts.app')

@section('content')
<h1>Moje narudžbine</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Proizvod</th>
            <th>Opis</th>
            <th>Status</th>
            <th>Datum</th>
        </tr>
    </thead>
    <tbody>
        @foreach($zahtevi as $zahtev)
        <tr>
            <td>{{ $zahtev->id }}</td>
            <td>{{ $zahtev->Vrsta_proizvoda }}</td>
            <td>{{ $zahtev->Opis }}</td>
            <td>{{ $zahtev->Status ?? 'Na čekanju' }}</td>
            <td>{{ $zahtev->created_at->format('d.m.Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
