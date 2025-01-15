@extends('layouts.public')
@section('title', 'Utenti')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifica Utente') }}
        </h2>
    </x-slot>

    <div class="form-container">
        <div >
            <div >
                <h3 >Modifica i dettagli dell'utente</h3>

                <!-- Mostra errori di validazione -->
                @if ($errors->any())
                    <div >
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form di modifica -->
                <form action="{{ route('utenti.update', $utente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nome -->
                    <div >
                        <label for="nome" >Nome</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome', $utente->nome) }}">
                    </div>

                    <!-- Cognome -->
                    <div >
                        <label for="cognome" >Cognome</label>
                        <input type="text" name="cognome" id="cognome" value="{{ old('cognome', $utente->cognome) }}">
                    </div>
                    <!-- Data di nascita -->
                    <div >
                        <label for="data_di_nascita" >Data si nascita</label>
                        <input type="date" name="data_di_nascita" id="data_di_nascita" value="{{ old('data_di_nascita', $utente->data_di_nascita) }}" >
                    </div>

                    <!-- Email -->
                    <div >
                        <label for="email" >Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email', $utente->email) }}">
                    </div>

                    <!-- Username -->
                    <div >
                        <label for="username" >Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $utente->username) }}">
                    </div>

                   @if($utente->tipo_account=="tecnico")

                    <!-- Specializzazione (solo per tecnici) -->
                    <div >
                        <label for="specializzazione" >Specializzazione (solo per tecnici)</label>
                        <input type="text" name="specializzazione" id="specializzazione" value="{{ old('specializzazione', $utente->specializzazione) }}" >
                    </div>
                    <!--Centro Assistenza -->
                    <div>
                        <label for="centro_assistenza_id" >Centro Assistenza(solo per i Tecnici)</label>
                        <select name="centro_assistenza_id" id="centro_assistenza_id">
                        <option value="">-- Seleziona un centro di assistenza --</option>
                        @foreach($centri_assistenza as $centro)
                            <option value="{{ $centro->id }}">{{ $centro->indirizzo }} - {{ $centro->città }}
                                {{old('centro_assistenza',$utente->centro_assistenza_id)}}>
                                
                            </option>
                        @endforeach
                        </select>
                    </div>
                    @endif
                    @if($utente->tipo_account=="staff")
                   <!-- Tipo Prodotto -->
                    <div>
                        <label for="tipo_prodotto">Tipo Prodotto</label>
                        <select name="tipo_prodotto" id="tipo_prodotto">
                            <option value="">-- Seleziona un tipo prodotto --</option>
                            @foreach($tipiprodotti as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('tipo_prodotto', $utente->tipo_prodotto) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    @endif
                    <!-- Password -->
                    <div >
                        <label for="password" >Nuova Password (lascia vuoto per mantenere quella attuale)</label>
                        <input type="text" name="password" id="password" >
                    </div>

                    <!-- Conferma Password -->
                    <div >
                        <label for="password_confirmation" >Conferma Password</label>
                        <input type="text" name="password_confirmation" id="password_confirmation">
                    </div>

                    <!-- Bottone per salvare -->
                    <div >
                        <button type="submit" class="submit-btn">
                            Salva
                    </button>
                    </div>

                    <!-- Pulsante Annulla -->
                    <div >
                        <a href="{{ route('utenti.index') }}" class="logout-button";>
                            Annulla
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
