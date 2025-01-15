@extends('layouts.public')
@section('title', 'Dashboard')
@section('content')
    <x-slot name="header">

    </x-slot>
    <div class="sfondo-container">
    <img src="{{ asset('images/banner.jpg') }}" alt="Assistenza back">
    </div>

    <div class="section">
        <div class="section welcome">
                <h1 >Benvenuto, {{ auth()->user()->nome }}({{ auth()->user()->tipo_account}})</h1>
                
            </div>
            <div class="section services">
            <h2 >Per la gestione Prodotti:</h2>
                <a href="{{ route('prodotti.index') }}" class="nav-button">
                    Prodotti
                </a>
            </div>
            @if(auth()->user()->isAdmin())
            <!-- Aggiunta del pulsante per la view utenti -->
            <div class="section contact">
            <h2 >Per la gestione Utenti:</h2>
                <a href="{{ route('utenti.index') }}" class="nav-button ">
                    Gestione Utenti
                </a>
            </div>
            @endif
        </div>
    </div>
@endsection
