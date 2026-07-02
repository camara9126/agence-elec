<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
     protected $fillable = [
        'nom',
        'telephone',
        'email',
        'adresse',
        'logo',
        'taux_tva',
        'ninea',
        'rccm',
        'rib',
    ];

    public function devis()
    {
        return $this->hasMany(Devis::class);
    }
}
