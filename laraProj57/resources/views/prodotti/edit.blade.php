@extends('layouts.public')
@section('title', 'Prodotti')
@section('content')
    <div class="form-container">
    
        <h1 class="text-2xl font-bold mb-4">Modifica Prodotto</h1>

        <!-- Form per la modifica del prodotto -->
        <form action="{{ route('prodotti.update', $prodotto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="descrizione">Descrizione</label>
        <textarea id="descrizione" name="descrizione" required>{{ $prodotto->descrizione }}</textarea>
    </div>

    <div>
        <label for="tecniche_d_uso">Tecniche d'Uso</label>
        <textarea id="tecniche_d_uso" name="tecniche_d_uso" required>{{ $prodotto->tecniche_d_uso }}</textarea>
    </div>

    <div>
        <label for="modalita_installazione">Modalità d'Installazione</label>
        <textarea id="modalita_installazione" name="modalita_installazione" required>{{ $prodotto->modalita_installazione }}</textarea>
    </div>

    <div>
        <label for="tipo_prodotto_id">Tipo di Prodotto</label>
        <select id="tipo_prodotto_id" name="tipo_prodotto_id" required>
            @foreach ($tipiProdotto as $tipo)
                <option value="{{ $tipo->id }}" {{ $prodotto->tipo_prodotto_id == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="foto">Foto (opzionale)</label>
        <input type="file" id="foto" name="foto">
    </div>

    <button type="submit"  class="submit-btn">Aggiorna</button>
</form>


        <!-- Pulsante per tornare alla lista dei prodotti -->
        <div class="mt-4">
            <a href="{{ route('prodotti.index') }}">
                Torna alla Lista dei Prodotti
            </a>
        </div>
    </div>
@endsection