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
        <h1 class="text-2xl font-bold mb-4">Crea Nuovo Tecnico</h1>

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
                    
                    <option value="tecnico">Tecnico</option>
                    
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
            <!-- Centro Assistenza (mostrato solo se l'utente è tecnico) -->
            <div id="centro_assistenza_container" >
                <label for="centro_assistenza_id" >Centro Assistenza(solo per i Tecnici)</label>
                <select name="centro_assistenza_id" id="centro_assistenza_id">
                    <option value="">-- Seleziona un centro di assistenza --</option>
                    @foreach($centri_assistenza as $centro)
                        <option value="{{ $centro->id }}">{{ $centro->indirizzo }} - {{ $centro->città }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Specializzazione (mostrato solo se l'utente è tecnico) -->
            <div id="specializzazione_container" >
                <label for="specializzazione" >Specializzazione(solo per i Tecnici)</label>
                <input type="text" name="specializzazione" id="specializzazione">
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
