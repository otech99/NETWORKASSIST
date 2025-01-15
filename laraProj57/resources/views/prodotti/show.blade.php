@extends('layouts.public')
@section('title', 'Prodotti')
@section('content')
    <!-- Contenuto della pagina -->
    <div class="container">
        <!-- Dettagli Prodotto -->
        <div class="section">
            <h2><strong>Prodotto:</strong> {{ $prodotto->id }}</h2>
            <div class="prodotto-container">
            <img src="{{ asset('images/' . $prodotto->foto) }}" alt="{{ $prodotto->id }}" class="product-img">
        </div>
        </div>
         <!-- Tabella -->
         <table class="zebra-table" id="prodotti-table">
            <thead>
                <tr>
                    
                    <th >Id</th>
                    <th >Descrizione</th>
                    <th>Tecniche d'Uso</th>
                    <th>Modalità di Installazione</th>
                 
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td >{{ $prodotto->id }}</td>
                        <td >{{ $prodotto->descrizione }}</td>
                        <td>{{ $prodotto->tecniche_d_uso }}</td>
                        <td>{{ $prodotto->modalita_installazione }}</td>
                       
                        

                       
                    </tr>
               
               
            </tbody>
        </table> 
        <!-- Tabella Malfunzionamenti e Soluzioni -->
        <div class="malfunction-table mt-5">
            <h1> Malfunzionamenti e Soluzioni</h1>
            <table class="zebra-table" id="malfunction-table">
                <thead>
                    <tr>
                        <th>Malfunzionamento</th>
                        <th>Soluzioni</th>
                        @if(auth()->user()->isStaff())
                        @if($prodotto->tipo_prodotto_id == $user->tipo_prodotto)
                        <th >Gestione Malfunzionamenti</th> <!-- Colonna per le azioni -->
                        @endif
                        @endif
                        <th><input type="text" id="search-malfunction" placeholder="Cerca malfunzionamento..." onkeyup="searchMalfunctions()" ></th>
                    </tr>
                </thead>
                <tbody id="malfTabella">
                    @foreach ($prodotto->malfunzionamenti as $malfunzionamento)
                        <tr>
                            
                            <td>{{ $malfunzionamento->descrizione }}</td>
                            <td>
                                    @foreach ($malfunzionamento->soluzioni as $soluzione)
                                        {{ $soluzione->descrizione }}
                                    @endforeach
                            </td>
                            @if(auth()->user()->isStaff())
                           
                        
                                 @if($prodotto->tipo_prodotto_id == $user->tipo_prodotto)
                                 <td>
                                    <a href="{{ route('malfunzionamenti.edit', [$prodotto->id, $malfunzionamento->id]) }}" class="nav-button">Modifica</a>
                                    <form action="{{ route('malfunzionamenti.destroy', [$prodotto->id, $malfunzionamento->id]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="del-button">Elimina</button>
                                    </form>
                                    @endif
                            </td>
                        
                        @endif
                        <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    @if($prodotto->tipo_prodotto_id == $user->tipo_prodotto)
    <h2 class="text-xl font-semibold mt-6">Aggiunta nuovo Malfunzionamento</h2>
                <div class= section>
                        Per aggiungere un malfunzionamento con soluzione:
                        <a href="{{ route('malfunzionamenti.create',  $prodotto->id) }}" class="agg-button">Aggiungi Malfunzionamento</a>
                   </div>
                   @endif
@endsection
