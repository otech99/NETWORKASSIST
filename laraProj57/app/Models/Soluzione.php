<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soluzione extends Model
{
    use HasFactory;

    // Specifica la tabella corretta
    protected $table = 'soluzioni';

    // Rimuovi l'impostazione per disabilitare l'auto-incremento
    public $incrementing = true;

    // Non è più necessario specificare che la chiave primaria è una stringa
    protected $fillable = ['malfunzionamento_id', 'descrizione'];

    // Relazione con Malfunzionamento
    public function malfunzionamento()
    {
        return $this->belongsTo(Malfunzionamento::class);
    }
}
