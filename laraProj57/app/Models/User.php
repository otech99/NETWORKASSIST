<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Relazione con CentroAssistenza
    public function centroAssistenza()
    {
        return $this->belongsTo(CentroAssistenza::class, 'centro_assistenza_id', 'id');
    }
    // Relazione con Prodotto
    public function Prodotto()
    {
        return $this->belongsTo(Prodotto::class, 'tipo_prodotto', 'tipo_prodotto');
    }
    // Metodo per verificare se l'utente è staff
    public function isStaff()
    {
        return $this->tipo_account === 'staff';
    }

    // Metodo per verificare se l'utente è admin
    public function isAdmin()
    {
        return $this->tipo_account === 'admin';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'id', 'username', 'email', 'nome', 'cognome', 'data_di_nascita', 
        'specializzazione', 'password', 'tipo_account', 'centro_assistenza_id','tipo_prodotto'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function hasRole($tipo_account): bool {
        $tipo_account = (array) $tipo_account;
        return in_array($this->role, $tipo_account);
    }
}
