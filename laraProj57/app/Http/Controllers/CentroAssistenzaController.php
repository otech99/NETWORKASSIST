<?php

namespace App\Http\Controllers;

use App\Models\CentroAssistenza;
use Illuminate\Http\Request;

class CentroAssistenzaController extends Controller
{
    public function index()
    {
        $centri = CentroAssistenza::all();
        return view('centriAss', compact('centri'));
    }

    public function create()
    {
        return view('centriAss.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'indirizzo' => 'required|string|max:255',
            'citta' => 'required|string|max:255',
            'telefono' => 'required|string|regex:/^[0-9]{1,12}$/',
        ]);

        CentroAssistenza::create($validatedData);

        return redirect()->route('centriAss.index')->with('success', 'Centro di assistenza creato con successo.');
    }

    public function edit($id)
    {
        $centro = CentroAssistenza::findOrFail($id);
        return view('centriAss.edit', compact('centro'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'indirizzo' => 'required|string|max:255',
            'citta' => 'required|string|max:255',
            'telefono' => 'required|string|regex:/^[0-9]{1,12}$/',
        ]);

        $centro = CentroAssistenza::findOrFail($id);
        $centro->update($data);

        return redirect()->route('centriAss.index')->with('success', 'Centro di assistenza aggiornato con successo.');
    }

    public function destroy($id)
    {
        $centro = CentroAssistenza::findOrFail($id);
        $centro->delete();

        return redirect()->route('centriAss.index')->with('success', 'Centro di assistenza eliminato con successo.');
    }

    public function search(Request $request)
    {
        $term = $request->input('term');
        $centri = CentroAssistenza::where('citta', 'LIKE', "%{$term}%")
            ->orWhere('indirizzo', 'LIKE', "%{$term}%")
            ->orWhere('telefono', 'LIKE', "%{$term}%")
            ->get();

        return response()->json($centri);
    }
}
