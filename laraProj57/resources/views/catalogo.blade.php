@extends('layouts.public')
@section('title', 'Catalogo')
@section('content')
    <div class="section">
        <h2>CATALOGO PRODOTTI</h2>

      
        <div class="search-container">
            <input type="text" id="search" placeholder="Cerca Prodotto"onkeyup="searchProducts()" />
        </div>
        <table class="prodotti-table" id="prodotti-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Prodotto</th>
                    <th>Descrizione</th>
                    <th>Tecniche d'Uso</th>
                    <th>Modalità di Installazione</th>
                    <th></th>
                </tr>
            </thead>
            <tbody  id="prodottiTabella">
                @forelse($prodotti as $prodotto)
                    <tr>
                        <td><img src="{{ asset('images/' . $prodotto->foto) }}" alt="{{ $prodotto->id }}" class="product-img"></td>
                        <td>{{ $prodotto->id }}</td>
                        <td>{{ $prodotto->descrizione}}</td>
                        <td>{{ $prodotto->tecniche_d_uso }}</td>
                        <td>{{ $prodotto->modalita_installazione }}</td>
                        <td>
                            <a href="{{ route('prodotti.show', $prodotto->id) }}" class="nav-button">
                                +
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Nessun prodotto disponibile</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> 
@endsection
