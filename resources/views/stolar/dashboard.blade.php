@extends('layouts.deashboard')
@php
    $user = auth()->user();
@endphp

@section('content')
<h1>Dobrodošao stolar!</h1>
<p>Ovo je tvoj dashboard.</p>
@endsection
