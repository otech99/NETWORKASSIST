@extends('layouts.public')
@section('title', 'Malfunzionamenti')
@section('content')
    <div class="form-container">
        <h1 class="text-2xl font-bold mb-4">Modifica Malfunzionamento per {{ $prodotto->scheda_tecnica }}</h1>
        
        <form action="{{ route('malfunzionamenti.update', [$prodotto->id, $malfunzionamento->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Descrizione del Malfunzionamento -->
            <div>
                <label for="descrizione" >Descrizione del Malfunzionamento</label>
                <textarea name="descrizione" id="descrizione" rows="4"  required>{{ $malfunzionamento->descrizione }}</textarea>
            </div>

            <!-- Descrizione delle Soluzioni -->
            <div>
                <label for="soluzioni" >Descrizione delle Soluzioni</label>

                    @foreach ($malfunzionamento->soluzioni as $index => $soluzione)
                            <!-- Testo descrizione soluzione -->
                            <textarea name="soluzioni[{{ $index }}][descrizione]" rows="2"  required>{{ $soluzione->descrizione }}</textarea>
                            <!-- Campo nascosto per l'ID soluzione -->
                            <input type="hidden" name="soluzioni[{{ $index }}][id]" value="{{ $soluzione->id }}">
                    @endforeach
            </div>
            <!-- Bottone di Aggiornamento -->
            <div>
                <button type="submit" class="submit-btn">
                    Aggiorna
                </button>
                </div>
            <a href="{{ route('prodotti.show', $prodotto->id) }}"  >Annulla</a>
        </form>
    </div>
@endsection
