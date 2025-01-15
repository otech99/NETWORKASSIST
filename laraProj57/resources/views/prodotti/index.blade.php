@extends('layouts.public')
@section('title', 'Prodotti')
@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Elenco Prodotti</h1>

        <!-- Tabella -->
        <table class="prodotti-table" id="prodotti-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th >Id</th>
                    <th >Descrizione</th>
                    @if(auth()->user()->isAdmin())
                    <th >Azioni</th>
                    @endif
                    <th >More</th>
                    

                   
                </tr>
            </thead>
            <tbody id="prodottiTabella">
                @foreach($prodotti as $prodotto)
                    <tr>
                        <td><img src="{{ asset('images/' . $prodotto->foto) }}" alt="{{ $prodotto->id }}" class="product-img"></td>
                        <td >{{ $prodotto->id }}</td>
                        <td >{{ $prodotto->descrizione }}</td>

                        @if(auth()->user()->isAdmin())
                            <td >
                                <a href="{{ route('prodotti.edit', $prodotto->id) }}" class="nav-button">
                                    Modifica
                                </a>
                               <form action="{{ route('prodotti.destroy', $prodotto->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="del-button" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?')">
                                        Elimina
                                    </button>
                               </form>

                            </td>
                        @endif
                        <td >
                                <a href="{{ route('prodotti.show', $prodotto->id) }}" class="nav-button">
                                    +
                                </a>
                            </td>
                        
                        

                       
                    </tr>
                @endforeach
               
            </tbody>
        </table> 
        </div>
        @if(auth()->user()->isAdmin()) <!-- Solo per Admin -->
        <h2>Gestione Tipi di Prodotto</h2>
        <table class="zebra-table" id="tipi_prodotti-table">
            <thead>
                <tr>
                    <th>tipi prodotto</th>
                    <th>Gestione</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($tipiProdotto as $tipo)
                <tr>
                    <td>
                            <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                    </td>
                    <td><!-- Form per eliminare un tipo di prodotto -->
                    <form action="{{ route('tipi_prodotto.destroy', $tipo->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="del-button" onclick="return confirm('Sei sicuro di voler eliminare questo tipo di prodotto?')">
                            Elimina
                        </button>
                    </form></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Aggiungi un nuovo tipo di prodotto</h3>
           <!-- Form per aggiungere un nuovo tipo di prodotto -->
        <form action="{{ route('tipi_prodotto.store') }}" method="POST">
            @csrf
            <div class="form-container">
                <h3>Nome Tipo di Prodotto</h3>
                <input type="text" id="nome" name="nome" placeholder="Inserisci il nome del tipo di prodotto" required>
            
            <button type="submit" class="agg-button">Aggiungi</button>
        </div>
        </form>
    
            <h2 class="text-xl font-semibold mt-6">Aggiunta nuovo Prodotto</h2>
                        <div class= section>
                                Per aggiungere un prodotto :
                                <a href="{{ route('prodotti.create') }}" class="agg-button">
                                    Aggiungi Prodotto
                                </a>
                        </div>
        @endif
@endsection
