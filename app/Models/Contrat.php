<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
     protected $fillable = [
        'titre',
        'reference',
        'contenu',
        'date',
        'statut',
        'editeur'
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
