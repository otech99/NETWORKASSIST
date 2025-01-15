<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CentroAssistenza;
use App\Models\Prodotto;
use App\Models\TipiProdotto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtenteController extends Controller
{
    public function showUtenti()
    {
        $tecnici = User::where('tipo_account', 'tecnico')->get();
        $staff = User::where('tipo_account', 'staff')->get();
        $centri= CentroAssistenza::all();

        return view('utenti.index', compact('tecnici', 'staff','centri'));
    }

    public function edit($id)
    {
        $utente = User::findOrFail($id);
        $tipiprodotti = TipiProdotto::all();
        $centri_assistenza = CentroAssistenza::all();

        return view('utenti.edit', compact('utente', 'tipiprodotti', 'centri_assistenza'));
    }

    public function update(Request $request, $id)
    {
        $utente = User::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:16',
            'cognome' => 'required|string|max:16',
            'data_di_nascita' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'username' => 'required|string|min:8|unique:users,username,' . $id,
            'password' => 'nullable|string|size:8|confirmed',
            'specializzazione' => 'nullable|string|max:255',
            'tipo_prodotto' => 'nullable|string',
            'centro_assistenza_id' => 'nullable|exists:centri_assistenza,id|integer',
        ]);

        $utente->update([
            'nome' => $request->input('nome'),
            'cognome' => $request->input('cognome'),
            'data_di_nascita' => $request->input('data_di_nascita'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'specializzazione' => $request->input('specializzazione'),
            'centro_assistenza_id' => $request->input('centro_assistenza_id'),
            'tipo_prodotto' => $request->input('tipo_prodotto'),
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $utente->password,
        ]);

        return redirect()->route('utenti.index')->with('success', 'Utente aggiornato con successo.');
    }

    public function destroy($id)
    {
        $utente = User::findOrFail($id);
        $utente->delete();

        return redirect()->route('utenti.index')->with('success', 'Utente eliminato con successo.');
    }

    public function createStaff()
    {
        $centri_assistenza = CentroAssistenza::all();
        $tipiprodotti = TipiProdotto::all();
        $prodotti = Prodotto::all();

        return view('utenti.createStaff', compact('centri_assistenza', 'prodotti', 'tipiprodotti'));
    }

    public function createTecn()
    {
        $centri_assistenza = CentroAssistenza::all();
        $prodotti = Prodotto::all();

        return view('utenti.createTecn', compact('centri_assistenza', 'prodotti'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:16',
            'cognome' => 'required|string|max:16',
            'username' => 'required|string|unique:users,username|max:16',
            'email' => 'required|string|unique:users,email|max:255',
            'data_di_nascita' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                'regex:/^\d{4}-\d{2}-\d{2}$/',
            ],
            'password' => 'required|string|min:8',
            'tipo_account' => 'required|in:tecnico,staff',
            'centro_assistenza_id' => 'nullable|exists:centri_assistenza,id|integer',
            'specializzazione' => 'nullable|string|max:255',
            'tipo_prodotto' => 'nullable|string',
        ], [
            'data_di_nascita.required' => 'La data di nascita è obbligatoria.',
            'data_di_nascita.date' => 'Il formato della data non è valido.',
            'data_di_nascita.before_or_equal' => 'Devi avere almeno 18 anni.',
        ]);

        $emailDomain = $validatedData['tipo_account'] === 'tecnico' ? '@tecn.com' : '@staff.com';
        $email = $validatedData['email'] . $emailDomain;

        User::create([
            'nome' => $validatedData['nome'],
            'cognome' => $validatedData['cognome'],
            'username' => $validatedData['username'],
            'data_di_nascita' => $validatedData['data_di_nascita'],
            'email' => $email,
            'password' => bcrypt($validatedData['password']),
            'tipo_account' => $validatedData['tipo_account'],
            'centro_assistenza_id' => $validatedData['centro_assistenza_id'] ?? null,
            'tipo_prodotto' => $validatedData['tipo_prodotto'] ?? null,
            'specializzazione' => $validatedData['specializzazione'] ?? null,
        ]);

        return redirect()->route('utenti.index')->with('success', 'Utente creato con successo.');
    }
}
