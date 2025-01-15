<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Malfunzionamento extends Model
{
    use HasFactory;

    // Specifica la tabella corretta
    protected $table = 'malfunzionamenti';

    // L'ID è ora auto-incrementato
    public $incrementing = true;

    // Specifica che il tipo di chiave primaria è un numero
    protected $keyType = 'int';

    protected $fillable = ['prodotto_id', 'descrizione'];

    // Relazione con Prodotto
    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class);
    }

    // Relazione con Soluzione
    public function soluzioni()
    {
        return $this->hasMany(Soluzione::class);
    }
}
