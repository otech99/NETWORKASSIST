@extends('layouts.public')
@section('title', 'Utenti')
@section('content')
    <div class="container mx-auto px-4">
        <!-- Barra di ricerca -->
        <div class="section">
        <h1 class="text-2xl font-bold mb-4">Gestione Utenti</h1>
        <div class="cerca-container">
            <input type="text" id="cerca" placeholder="Cerca Utente" onkeyup="searchTable()" />
         </div>

         </div>
        <!-- Tabella per i Tecnici dei Centri di Assistenza -->
        <h2>Tecnici dei Centri di Assistenza</h2>
        <table class="zebra-table" id="tecnici-table">
            <thead>
                <tr>
                    <th >Nome</th>
                    <th >Cognome</th>
                    <th >Data di Nascita</th>
                    <th >Specializzazione</th>
                    <th >Centro</th>
                    <th >Username</th>
                    <th >Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tecnici as $tecnico)
                    <tr>
                        <td>{{ $tecnico->nome }}</td>
                        <td>{{ $tecnico->cognome }}</td>
                        <td>{{ $tecnico->data_di_nascita }}</td>
                        <td>{{ $tecnico->specializzazione }}</td>
                        <td>@foreach($centri as $centro)
                                @if($centro->id == $tecnico->centro_assistenza_id)
                                    {{ $centro->citta }}
                                @endif
                             @endforeach</td>
                        <td>{{ $tecnico->username }}</td>
                        <td>
                            <a href="{{ route('utenti.edit', $tecnico->id) }}" class="nav-button">Modifica</a>
                            <form action="{{ route('utenti.destroy', $tecnico->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="del-button" onclick="return confirm('Sei sicuro di voler eliminare questo utente?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2 >Aggiunta nuovo Tecnico</h2>
        <div class="section">
                        Per aggiungere un Tecnico:
                        <a href="{{ route('utenti.createTecn') }}" class="agg-button">Aggiungi</a>
        </div>
    </div>

        <!-- Tabella per i Membri dello Staff -->
        <h2 >Membri dello Staff</h2>
        <table class="zebra-table" id="staff-table">
            <thead>
                <tr>
                    <th >Nome</th>
                    <th >Cognome</th>
                    <th >Username</th>
                    <th >Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $membro)
                    <tr>
                        <td>{{ $membro->nome }}</td>
                        <td>{{ $membro->cognome }}</td>
                        <td>{{ $membro->username }}</td>
                        <td>
                            <a href="{{ route('utenti.edit', $membro->id) }}" class="nav-button">Modifica</a>
                            <form action="{{ route('utenti.destroy', $membro->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="del-button" onclick="return confirm('Sei sicuro di voler eliminare questo utente?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Aggiunta nuovo Staff -->
        <h2 >Aggiunta nuovo Staff</h2>
        <div class="section">
                        Per aggiungere un Utente:
                        <a href="{{ route('utenti.createStaff') }}" class="agg-button">Aggiungi</a>
        </div>
    </div>
    
   
@endsection
