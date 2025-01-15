<?php

namespace App\Http\Controllers;

use App\Models\Prodotto;
use App\Models\TipiProdotto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProdottoController extends Controller
{
    // Metodo per mostrare la lista di prodotti
    public function index()
    {
        $prodotti = Prodotto::all(); 
        $tipiProdotto = TipiProdotto::all();
        return view('prodotti.index', compact('prodotti','tipiProdotto'));
    }
    public function show($id)
{
    $prodotto = Prodotto::with(['malfunzionamenti.soluzioni'])->findOrFail($id); // Recupera il prodotto e le relazioni
    $user = auth()->user(); // Recupera l'utente autenticato

    return view('prodotti.show', compact('prodotto', 'user')); // Passa il prodotto e l'utente alla view
}


    
    // Metodo per mostrare il form di creazione di un nuovo prodotto
    public function create()
{
    $tipiProdotto = TipiProdotto::all();
    return view('prodotti.create', compact('tipiProdotto'));
}


    // Metodo per salvare un nuovo prodotto nel database

    public function store(Request $request)
    {
        // Validazione dei dati
        $validated = $request->validate([
            'tipo_prodotto_id' => 'required|exists:tipi_prodotto,id',
            'descrizione' => 'required|string',
            'tecniche_d_uso' => 'required|string',
            'modalita_installazione' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Gestione del nuovo tipo di prodotto
        if ($request->tipo_prodotto_id === 'new') {
            $newTipo = TipiProdotto::create([
                'nome' => $request->input('new_tipo_prodotto'),
            ]);
            $validated['tipo_prodotto_id'] = $newTipo->id;
        }
    
        // Gestione del caricamento dell'immagine
        if ($request->hasFile('foto')) {
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('images'), $imageName);
            $validated['foto'] =  $imageName; // Salva il percorso relativo
        }
    
        // Creazione del prodotto
        Prodotto::create($validated);
    
        return redirect()->route('prodotti.index')->with('success', 'Prodotto aggiunto con successo!');
    }
    
    public function edit($id)
{
    $prodotto = Prodotto::findOrFail($id);
    $tipiProdotto = TipiProdotto::all();
    return view('prodotti.edit', compact('prodotto', 'tipiProdotto'));
}


    public function update(Request $request, $id)
    {
        $prodotto = Prodotto::findOrFail($id);
    
        // Validazione dei dati
        $validated = $request->validate([
            'tipo_prodotto_id' => 'required|exists:tipi_prodotto,id',
            'descrizione' => 'required|string',
            'tecniche_d_uso' => 'required|string',
            'modalita_installazione' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Gestione del caricamento dell'immagine (opzionale)
        if ($request->hasFile('foto')) {
            $imageName = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('images'), $imageName);
            $validated['foto'] = $imageName; // Salva il percorso relativo
        }
    
        // Aggiorna il prodotto con i nuovi dati
        $prodotto->update($validated);
    
        return redirect()->route('prodotti.show', $prodotto->id)
                         ->with('success', 'Prodotto aggiornato con successo.');
    }
    

    public function destroy($id)
    {
        $prodotto = Prodotto::findOrFail($id);
     // Elimina l'immagine
     $filePath = public_path('images/' . $prodotto->foto);
     if (file_exists($filePath)) {
         unlink($filePath);
     }
 
        $prodotto->delete();

        return redirect()->route('prodotti.index')
                         ->with('success', 'Prodotto eliminato con successo.');
    }
     // Funzione per creare un nuovo tipo di prodotto
     public function storeTipoProdotto(Request $request)
     {
         // Validazione dei dati
         $validated = $request->validate([
             'nome' => 'required|string|unique:tipi_prodotto,nome|max:255',
         ]);
 
         // Salvataggio nel database
         TipiProdotto::create($validated);
 
         return redirect()->route('prodotti.index')->with('success', 'Tipo di prodotto aggiunto con successo!');
     }
         // Funzione per eliminare un tipo di prodotto
    public function destroyTipoProdotto($id)
    {
        $tipoProdotto = TipiProdotto::findOrFail($id);

        // Elimina il tipo di prodotto
        $tipoProdotto->delete();

        // Redirect con messaggio di successo
        return redirect()->route('catalogo')->with('success', 'Tipo di prodotto eliminato con successo!');
    }
    
    
 }

