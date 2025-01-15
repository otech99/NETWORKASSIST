<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroAssistenza extends Model
{
    use HasFactory;

    protected $table = 'centri_assistenza';

    // Abilita l'auto-incremento
    public $incrementing = true;

    // Specifica che il tipo di chiave primaria è BIGINT
    protected $keyType = 'int';

    protected $fillable = ['indirizzo', 'citta', 'telefono'];

    public function tecnici()
    {
        return $this->hasMany(User::class, 'centro_assistenza_id');
    }
}
