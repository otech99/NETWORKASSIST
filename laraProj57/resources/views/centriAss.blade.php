@extends('layouts.public')
@section('title', 'Centri Assistenza')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="section">
    <h2>Elenco dei Centri di Assistenza</h2>
    <table class="zebra-table" id="centri-table">
        <thead>
            <tr>
                <th>Centro</th>
                <th>Indirizzo</th>
                <th>Città</th>
                <th>Telefono</th>
                @if(Auth::check() && Auth::user()->isAdmin())
                <th>Gestione</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($centri as $centro)
                <tr>
                    <td>Centro Assistenza {{ $centro->citta }}</td>
                    <td>{{ $centro->indirizzo }}</td>
                    <td>{{ $centro->citta }}</td>
                    <td>{{ $centro->telefono }}</td>
                    @if(Auth::check() && Auth::user()->isAdmin())
                    <td>
                        <a href="{{ route('centriAss.edit', $centro->id) }}" class="nav-button">Modifica</a>
                        <form action="{{ route('centriAss.destroy', $centro->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="del-button" onclick="return confirm('Sei sicuro di voler eliminare questo centro?')">Elimina</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nessun centro d'assistenza trovato</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(Auth::check() && Auth::user()->isAdmin())
    <div class="add-container">
        <h2>Per Aggiungere un nuovo Centro</h2>
        <a href="{{ route('centriAss.create') }}" class="agg-button">Aggiungi Centro</a>
    </div>
@endif

@endsection
