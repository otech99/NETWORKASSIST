<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    use HasFactory;
        // Specifica la tabella corretta
        protected $table = 'prodotti';
        // Disabilita l'auto-incremento per il campo ID
        public $incrementing = true;

        // Specifica che il tipo di chiave primaria è una stringa
        protected $keyType = 'int';

        // Campi fillable
        protected $fillable = ['descrizione', 'tecniche_d_uso', 'modalita_installazione','tipo_prodotto_id','foto'];

            // Relazione con Malfunzionamento
    public function malfunzionamenti()
    {
        return $this->hasMany(Malfunzionamento::class);
    }
}

