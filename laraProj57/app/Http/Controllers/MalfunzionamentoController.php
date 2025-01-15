<?php

namespace App\Http\Controllers;

use App\Models\Prodotto;
use App\Models\Malfunzionamento;
use Illuminate\Http\Request;
use App\Models\Soluzione;

class MalfunzionamentoController extends Controller
{
    public function create($prodottoId)
    {
        $prodotto = Prodotto::findOrFail($prodottoId);

        return view('malfunzionamenti.create', compact('prodotto'));
    }

    public function store(Request $request, Prodotto $prodotto)
    {
        $data = $request->validate([
            'descrizione' => 'required|string',
            'soluzione' => 'required|string',
        ]);

        $malfunzionamento = new Malfunzionamento([
            'prodotto_id' => $prodotto->id,
            'descrizione' => $data['descrizione'],
        ]);
        $malfunzionamento->save();

        $soluzione = new Soluzione([
            'descrizione' => $data['soluzione'],
            'malfunzionamento_id' => $malfunzionamento->id,
        ]);
        $soluzione->save();

        return redirect()->route('prodotti.show', $prodotto->id)
                         ->with('success', 'Malfunzionamento e soluzione aggiunti con successo.');
    }

    public function edit($prodottoId, $malfunzionamentoId)
    {
        $prodotto = Prodotto::findOrFail($prodottoId);
        $malfunzionamento = Malfunzionamento::findOrFail($malfunzionamentoId);

        return view('malfunzionamenti.edit', compact('prodotto', 'malfunzionamento'));
    }

    public function update(Request $request, Prodotto $prodotto, Malfunzionamento $malfunzionamento)
    {
        $validatedData = $request->validate([
            'descrizione' => 'required|string|max:255',
            'soluzioni.*.descrizione' => 'required|string|max:255',
        ]);

        $malfunzionamento->update([
            'descrizione' => $validatedData['descrizione'],
        ]);

        foreach ($malfunzionamento->soluzioni as $index => $soluzione) {
            if (isset($validatedData['soluzioni'][$index])) {
                $soluzione->update([
                    'descrizione' => $validatedData['soluzioni'][$index]['descrizione'],
                ]);
            }
        }

        return redirect()->route('prodotti.show', $prodotto->id)
                         ->with('success', 'Malfunzionamento e soluzioni aggiornati con successo.');
    }

    public function destroy(Prodotto $prodotto, Malfunzionamento $malfunzionamento)
    {
        $malfunzionamento->delete();

        return redirect()->route('prodotti.show', $prodotto->id)
                         ->with('success', 'Malfunzionamento eliminato con successo.');
    }
}
