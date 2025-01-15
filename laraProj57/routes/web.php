<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Catalogocontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdottoController;
use App\Http\Controllers\MalfunzionamentoController;
use App\Http\Controllers\CentroAssistenzaController;
use App\Http\Controllers\UtenteController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StaffMiddleware;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Rotte per la gestione Utenti solo per l'admin
Route::middleware('auth',AdminMiddleware::class)->group(function() {
        // Rotta per visualizzare la lista degli utenti
        Route::get('/utenti', [UtenteController::class, 'showUtenti'])->name('utenti.index');
        // Rotta per visualizzare il form di modifica di un utente esistente
        Route::get('/utenti/{id}/edit', [UtenteController::class, 'edit'])->name('utenti.edit');
        // Rotta per aggiornare le informazioni di un utente
        Route::put('/utenti/{id}', [UtenteController::class, 'update'])->name('utenti.update');
        // Rotta per eliminare un utente
        Route::delete('/utenti/{id}', [UtenteController::class, 'destroy'])->name('utenti.destroy');
        // Rotta per visualizzare il form di creazione di un nuovo utente
        Route::get('/utenti/createStaff', [UtenteController::class, 'createStaff'])->name('utenti.createStaff');
        Route::get('/utenti/createTecn', [UtenteController::class, 'createTecn'])->name('utenti.createTecn');
        // Rotta per salvare un nuovo utente nel database
        Route::post('/utenti', [UtenteController::class, 'store'])->name('utenti.store');
        });
        
// Rotte per la gestione dei malfunzionamenti solo per membri dello staff
Route::prefix('prodotti')->middleware('auth',StaffMiddleware::class)->group(function() {
        // Rotta per creare un malfunzionamento con l'ID del prodotto rispettivo
        Route::get('prodotti/{prodottoId}/malfunzionamenti/create', [MalfunzionamentoController::class, 'create'])->name('malfunzionamenti.create');
        route::post('/{prodotto}/malfunzionamenti', [MalfunzionamentoController::class, 'store'])->name('malfunzionamenti.store');
        // Rotta per modificare un malfunzionamento esistente
        Route::get('/{prodotto}/malfunzionamenti/{malfunzionamento}/edit', [MalfunzionamentoController::class, 'edit'])
            ->name('malfunzionamenti.edit');
        // Rotta per aggiornare un malfunzionamento esistente
        Route::put('/{prodotto}/malfunzionamenti/{malfunzionamento}', [MalfunzionamentoController::class, 'update'])
            ->name('malfunzionamenti.update');
        // Rotta per eliminare un malfunzionamento
        Route::delete('/{prodotto}/malfunzionamenti/{malfunzionamento}', [MalfunzionamentoController::class, 'destroy'])
            ->name('malfunzionamenti.destroy');
    });
    Route::post('/tipi-prodotto', [ProdottoController::class, 'storeTipoProdotto'])->name('tipi_prodotto.store');
    Route::delete('/tipi-prodotto/{id}', [ProdottoController::class, 'destroyTipoProdotto'])->name('tipi_prodotto.destroy');

// Rotte per i prodotti (solo visualizzazione)
Route::middleware('auth')->group(function() {
        Route::resource('prodotti', ProdottoController::class)->only(['index', 'show']);
        });
        //Rotte per la gestione Prodotti
        Route::middleware('auth',AdminMiddleware::class)->group(function() {
            Route::get('prodotti/prodotti/create', [ProdottoController::class, 'create'])->name('prodotti.create');
            Route::post('prodotti/prodotti', [ProdottoController::class, 'store'])->name('prodotti.store');
            Route::get('/prodotti/{id}/edit', [ProdottoController::class, 'edit'])->name('prodotti.edit');
            Route::put('/prodotti/{id}', [ProdottoController::class, 'update'])->name('prodotti.update');
            Route::delete('/prodotti/{id}', [ProdottoController::class, 'destroy'])->name('prodotti.destroy');
        });
        //rotta dashboard
Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/catalogo', [Catalogocontroller::class, 'index'])->name('catalogo');
//rotte per le pagine pubbliche
Route::get('/', function () {return view('welcome');})->name('welcome')->middleware('public.access');
Route::view('/where', 'where')->name('where')->middleware('public.access');
// Mostra l'elenco dei centri
Route::get('/centriAss', [CentroAssistenzaController::class, 'index'])->name('centriAss.index');
Route::middleware('auth',AdminMiddleware::class)->group(function() {
// Mostra il form di creazione
Route::get('/centriAss/create', [CentroAssistenzaController::class, 'create'])->name('centriAss.create');
// Salva un nuovo centro
Route::post('/centriAss', [CentroAssistenzaController::class, 'store'])->name('centriAss.store');
// Mostra il form di modifica
Route::get('/centriAss/{centro}/edit', [CentroAssistenzaController::class, 'edit'])->name('centriAss.edit');
// Aggiorna un centro esistente
Route::put('/centriAss/{centro}', [CentroAssistenzaController::class, 'update'])->name('centriAss.update');
// Elimina un centro esistente
Route::delete('/centriAss/{centro}', [CentroAssistenzaController::class, 'destroy'])->name('centriAss.destroy');
});
Route::get('/centri-assistenza/search', [CentroAssistenzaController::class, 'search'])->name('centriAss.search');

require __DIR__.'/auth.php';