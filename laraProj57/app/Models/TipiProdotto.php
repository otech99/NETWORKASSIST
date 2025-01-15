<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipiProdotto extends Model
{
    use HasFactory;

    protected $table = 'tipi_prodotto'; // Nome della tabella
    protected $fillable = ['nome'];    // Campi che possono essere riempiti
}
