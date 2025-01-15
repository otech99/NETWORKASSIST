@extends('layouts.public')
@section('title', 'Malfunzionamenti')
@section('content')
    <div class="form-container">
        <h1 class="text-2xl font-bold mb-4">Aggiungi Malfunzionamento</h1>
    
        <form action="{{ route('malfunzionamenti.store', [$prodotto->id]) }}" method="POST" id="malfunzionamentoForm">
    @csrf

    
    <div>
        <label for="descrizione" >Descrizione Malfunzionamento</label>
        <textarea name="descrizione" id="descrizione" rows="4"  required></textarea>
    </div>
    <div>
        <label for="soluzione" >Descrizione Soluzione</label>
        <textarea name="soluzione" id="soluzione" rows="4" required></textarea>
    </div>

    <div class="flex items-center justify-end">
        <button type="submit" class="submit-btn">
            Salva
        </button>
    </div>
    <a href="{{ route('prodotti.show', $prodotto->id) }}"  >Annulla</a>
    
</form>

    </div>


 

@endsection
