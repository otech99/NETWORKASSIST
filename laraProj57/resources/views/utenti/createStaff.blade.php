@extends('layouts.public')
@section('title', 'Utenti')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="form-container">
        <h1 class="text-2xl font-bold mb-4">Crea Nuovo Staff</h1>

        <form action="{{ route('utenti.store') }}" method="POST">
            @csrf

            <!-- Nome -->
            <div>
                <label for="nome" >Nome</label>
                <input type="text" name="nome" id="nome" required>
            </div>

            <!-- Cognome -->
            <div>
                <label for="cognome" >Cognome</label>
                <input type="text" name="cognome" id="cognome" required>
            </div>

            <!-- Username -->
            <div>
                <label for="username" >Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <!-- Data di Nascita -->
            <div>
                <label for="data_di_nascita" >Data di nascita</label>
                <input type="date" name="data_di_nascita" id="data_di_nascita" required>
            </div>
            <!-- Tipo Account -->
            <div>
                <label for="tipo_account" >Tipo Account</label>
                <select name="tipo_account" id="tipo_account" required>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <!-- Email -->
            <div>
                <label for="email" >Email(@tipo_account in auto)</label>
                <input type="text" name="email" id="email" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" >Password</label>
                <input type="text" name="password" id="password" required>
            </div>
            <!-- Conferma Password -->
            <div>
                <label for="password_confirmation" >Conferma Password</label>
                <input type="text" name="password_confirmation" id="password_confirmation" required>
            </div>
            <!-- Tipo Prodotto -->
            <div>
                        <label for="tipo_prodotto">Tipo Prodotto</label>
                        <select name ="tipo_prodotto" id="tipo_prodotto">
                        <option value="">Seleziona un tipo prodotto</option>
                        @foreach($tipiprodotti as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>

                        @endforeach
                        </select>
                    </div>
            <!-- Bottone per salvare -->
            <div>
                        <button type="submit" class="submit-btn">
                            Salva
                    </button>
                    </div>
<br>
                    <!-- Pulsante Annulla -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('utenti.index') }}" class="logout-button";>
                            Annulla
                        </a>
    </div>
    
@endsection
