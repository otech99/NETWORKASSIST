@extends('layouts.public')
@section('title', 'Prodotti')
@section('content')
    <div class="form-container">
    
        <h1 class="text-2xl font-bold mb-4">Aggiungi Prodotto</h1>

        <form action="{{ route('prodotti.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <!-- Tipo Prodotto -->
            <div class="mb-4">
                <label for="tipo_prodotto_id">Tipo di Prodotto</label>
                <select name="tipo_prodotto_id" id="tipo_prodotto_id" required>
                    @foreach($tipiProdotto as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                    @endforeach
                    
                </select>
            </div>
            <!-- Campo per la scheda tecnica -->
            <div class="mb-4">
                <label for="descrizione">Descrizione</label>
                <input type="text" name="descrizione" id="descrizione" required>
            </div>

            <!-- Campo per tecniche d'uso -->
            <div class="mb-4">
                <label for="tecniche_d_uso">Tecniche d'Uso</label>
                <input type="text" name="tecniche_d_uso" id="tecniche_d_uso" required>
            </div>

            <!-- Campo per modalità d'installazione -->
            <div class="mb-4">
                <label for="modalita_installazione">Modalità d'Installazione</label>
                <input type="text" name="modalita_installazione" id="modalita_installazione" required>
            </div>

            <!-- Campo per foto -->
            <div class="mb-4">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" required>
            </div>

            <!-- Bottone di invio -->
            <div class="flex justify-end">
                <button type="submit" class="submit-btn">
                    Aggiungi
                </button>
            </div>
        </form>
    </div>
    <!-- Mostra errori di validazione -->
    @if ($errors->any())
        <div class="error-messages">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
@endsection
